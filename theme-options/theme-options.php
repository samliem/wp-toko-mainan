<?php

/*****************************************************************
*********************** Register Setting ************************/

function jrl_register_setting() {
    //register_setting( $option_group, $option_name, $sanitize_callback
    register_setting( 'jrl_theme_options', 'jrl_theme_options', 'jrl_theme_options_validate' );
}
add_action( 'admin_init', 'jrl_register_setting' );

function jrl_theme_options_validate($options) {
    
    $old_options = (array) get_option('jrl_theme_options');
    
    /*if( isset($options['background_size']) ) {
        if( $options['background_size'] != 'cover' ) {
            $options['background_size'] = '';
        }
    } else {
        $options['background_size'] = '';
    } */
    
    if( isset($options['site_title']) ) {
        if( empty($options['site_title']) ) {
            $options['site_title'] = get_bloginfo('name');
        } else {
            $options['site_title'] = strip_tags($options['site_title']);
        }
    }
    
    if( isset($options['site_description']) ) {
        if( empty($options['site_description']) ) {
            $options['site_description'] = get_bloginfo('description');
        } else {
            $options['site_description'] = strip_tags($options['site_description']);
        }
    }
    
    if( isset($options['logo_image_url']) ) {
        if( !empty($options['logo_image_url']) ) {
            $options['logo_image_url'] = esc_url( $options['logo_image_url'] );
        }
    }
    
    if( isset($options['favicon']) ) {
        if( !empty($options['favicon']) ) {
            $options['favicon'] = esc_url( $options['favicon'] );
        }
    }
    
    if( isset($options['banner']) ) {
        if( !empty($options['banner']) ) {
            $options['banner'] = esc_url( $options['banner'] );
        }
    }
    
    if( isset($options['slider_img']) ) {
        for( $i=0; $i<count($options['slider_img']); $i++ ) {
            if( empty($options['slider_img'][$i]) ) {
                unset($options['slider_img'][$i]);
            } else {
                $options['slider_img'][$i] = esc_url($options['slider_img'][$i]);
                $options['slider_post'][$i] = strip_tags($options['slider_post'][$i]);
                $options['slider_title'][$i] = strip_tags($options['slider_title'][$i]);
            }
        }
    }
    
    if( isset($options['store']) ) {
        $options['store'] = strip_tags($options['store']);
    }
    
    if( isset($options['address1']) ) {
        $options['address1'] = strip_tags($options['address1']);
    }
    
    if( isset($options['address2']) ) {
        $options['address2'] = strip_tags($options['address2']);
    }
    
    if( isset($options['address3']) ) {
        $options['address3'] = strip_tags($options['address3']);
    }
    
    if( isset($options['phone']) ) {
        $options['phone'] = strip_tags($options['phone']);
    }
    
    if( isset($options['bbm']) ) {
        $options['bbm'] = strip_tags($options['bbm']);
    } 
       
    /*if( isset($options['product_column']) ) {
        $num_of_thumbnail_col = strip_tags($options['product_column']);
        if( is_numeric($num_of_thumbnail_col) ) {
            $options['product_column'] = $num_of_thumbnail_col;
        } else {
            $options['product_column'] = '';
        }
        
    }*/
    
    if( isset($options['max_product_page']) && !empty($options['max_product_page']) ) {
        $max_product = strip_tags($options['max_product_page']);
        if(is_numeric($max_product) ) {
            if( $max_product < 1 ) {
                $options['max_product_page'] = '';
            }
        } else {
            $options['max_product_page'] = '';
        }
    }
    
    if( isset($options['facebook']) ) {
        $options['facebook'] = esc_url($options['facebook']);
    }
    
    if( isset($options['twitter']) ) {
        $options['twitter'] = esc_url($options['twitter']);
    }
        
    $options = wp_parse_args($options, $old_options);
    
    return $options;
}

/*****************************************************************
****************** Set Default Theme Options ********************/

function jrl_get_default_options() {
    //-- Default value
    $theme_options = array(
        'logo_type'=> 'text',
        'site_title'=> get_bloginfo('name'),
        'site_description'=> get_bloginfo('description'),
        'post_content'=> 'excerpt',      // value : excerpt, full
        'post_paging'=> 'pagination',    // value : prevnext, pagination
    );
    
    return $theme_options;
}

function jrl_options_init() {
    $jrl_theme_options = get_option('jrl_theme_options');
    if( false === $jrl_theme_options ) {
        $jrl_theme_options = jrl_get_default_options();
        update_option( 'jrl_theme_options', $jrl_theme_options );
    }
}
add_action('after_setup_theme', 'jrl_options_init');

/*****************************************************************
******************** Change Thickbox Text ***********************/

function mod_thickbox_text() {
    global $pagenow;
    if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
	add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
    }
}
add_action( 'admin_init', 'mod_thickbox_text' );

function replace_thickbox_text($translated_text, $text) {
    if( 'insert into post' == strtolower($text) ) {
        $referer = strpos( wp_get_referer(), 'jrl-theme-settings' );
        if ( $referer != '' ) {
            switch($_COOKIE['jrl_theme_tab']) {
                case 'general':
                    return 'Gunakan gambar ini sebagai logo/favicon/banner';
                case 'slider':
                    return 'Gunakan gambar ini untuk slide';
                case 'social':
                    return 'Gunakan gambar ini untuk social icon';
            }
            
	}
    }
    
    return $translated_text;
}

/*****************************************************************
************** Create Theme Options Menu and Page ***************/

function jrl_menu_options() {
    
    //add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    add_theme_page( 'Theme Setting Option', 'Theme Options', 'edit_theme_options', 'theme-options', 'jrl_admin_options_page' );
    if( !isset($_COOKIE['jrl_theme_tab']) ) {
        setcookie('jrl_theme_tab', 'general', time()+86400, '/wordpress/wp-admin/', COOKIE_DOMAIN);
    }
}
add_action( 'admin_menu', 'jrl_menu_options' );

function jrl_admin_options_page() {
    
    wp_enqueue_style( 'theme-options', get_stylesheet_directory_uri() . '/theme-options/css/theme-options.css' );
    wp_enqueue_script( 'upload-image', get_stylesheet_directory_uri() . '/theme-options/js/upload-image.js', array('jquery') );
    wp_enqueue_script( 'tabs', get_stylesheet_directory_uri() . '/theme-options/js/tabs.js', array('jquery') );
    wp_enqueue_script( 'tab-cookie', get_stylesheet_directory_uri() . '/theme-options/js/jquery.cookie.js', array('jquery') );
    wp_enqueue_script( 'general', get_stylesheet_directory_uri() . '/theme-options/js/general.js', array('jquery','media-upload','thickbox') );
    wp_enqueue_script( 'sliders', get_stylesheet_directory_uri() . '/theme-options/js/slider.js', array('jquery','media-upload','thickbox') );
    ?>

    <!-- media caller storage -->
    <input type="hidden" id="media-caller" value="" />
    
    <div class="wrap">
        <div id="icon-themes" class="icon32"> </div>
        <h2>Theme Setting Options</h2>
        <?php if( isset( $_GET [ 'settings-updated' ] ) && 'true' == $_GET[ 'settings-updated' ] ): ?>
            <div class="updated" id="message">
		<p><strong>Setting sudah berhasil disimpan</strong></p>
            </div>
        <?php endif; ?>
        <ul id="tabs">
            <li <?php if( 'general' == $_COOKIE['jrl_theme_tab'] ) echo 'class="tab-active"'; ?>>
                <a href="#setting-general" id="general-tab">General</a>
            </li><!--
            --><li <?php if( 'slider' == $_COOKIE['jrl_theme_tab'] ) echo 'class="tab-active"'; ?>>
                    <a href="#setting-slider" id="home-slider-tab">Home Slider</a>
            </li><!--
            --><li <?php if( 'social' == $_COOKIE['jrl_theme_tab'] ) echo 'class="tab-active"'; ?>>
                <a href="#setting-social" id="social-tab">Social</a>
            </li>
        </ul>
        <!-- href pada anchor di atas tidak ditujukan ke id form karena tampilan akan naik
        pada waktu tab di click -->
        <?php $GLOBALS['jrl_theme_options'] = get_option('jrl_theme_options'); ?>
        <div id="tab-content">
            <?php get_template_part('theme-options/setting', 'general'); ?>
            <?php get_template_part('theme-options/setting', 'sliders'); ?>
            <?php get_template_part('theme-options/setting', 'social'); ?>
        </div>
    </div>
    <?php }
?>
