<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<?php do_action( 'theme_meta' ); ?>
    
<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php do_action( 'theme_font' ); ?> <!-- font links -->
<?php do_action( 'theme_links' ); ?> <!-- favicon, pingback, profile link -->

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php do_action('jrl_before_header'); ?>
    <div id="page" class="hfeed">
        <header id="masthead" class="site-header" role="banner">
            <div class="site-wrap">
                <hgroup>
                    <?php global $jrl_theme_options;?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <?php 
                            if( 'text'== $jrl_theme_options['logo_type'] ) {
                                $title_words = explode( " ", $jrl_theme_options['site_title'] );
                                if( count($title_words) > 1 ) {
                                    //membedakan warna untuk odd and even word
                                    $new_title = $title_words[0];
                                    for( $i=1; $i < count($title_words); $i++ ) {
                                        $c = $i + 1;
                                        if( $c % 2 == 0 )
                                            $new_title .= "<span>$title_words[$i]</span>";
                                        else
                                            $new_title .= $title_words[$i];
                                    }
                                    echo $new_title;
                                } else {
                                    echo $title_words;
                                }
                            } else { ?>
                                <img src="<?php echo $jrl_theme_options['logo_image_url']; ?>" />
                            <?php }?>
                        </a>
                    </h1>
                    <h2 class="site-description">
                        <?php if( 'text' == $jrl_theme_options['logo_type'] && 
                         !empty($jrl_theme_options['site_description']) ) echo $jrl_theme_options['site_description']; ?>
                    </h2>
                </hgroup>  

                <!-- Search Box -->
                <div id="search-product">
                    <?php get_product_search_form(); ?>
                </div>
                
                <!-- Phone Number -->
                <?php if( !empty($jrl_theme_options['phone']) ) : ?>
                    <div id="phone"><?php echo $jrl_theme_options['phone']; ?></div>
                <?php endif; ?>
                    
            </div><!-- .site-wrap -->
            
            <nav id="site-navigation" class="main-navigation" role="navigation">
		<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
                <div class="site-wrap">
                    <div class="site-title">
                        <?php echo $new_title; ?>
                    </div>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </div><!-- .site-wrap -->
            </nav><!-- #site-navigation -->

        </header><!-- #masthead -->
        
        <?php if( is_front_page() ) : ?>
            <div id="ad-banner-container">
                <div id="ad-banner">
                    <img src="<?php echo get_stylesheet_directory_uri(). '/images/728x90.gif'; ?>" >
                </div>
            </div>
        <?php endif; ?>
        
	<div id="main" class="wrapper">
            <?php if( !is_front_page() ) :?>
                <h3 class="entry-title">
                <?php 
                    if( is_singular() ) {
                        global $post; 
                        echo $post->post_title; 
                    }
                    
                    $queried_object = get_queried_object();
                       
                    switch ($queried_object->taxonomy) {
                        case 'category':
                                  printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                        case 'post_tag':
                            printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                        case 'product_cat':
                            printf( __( 'Product Category : %s', 'woocommerce' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                        case 'product_tag':
                            printf( __( 'Product Tag : %s', 'woocommerce' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                        case 'promo_cat':
                            printf( __( 'Promotion Category %s: ', 'twentytwelve' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                        case 'promo_tag':
                            printf( __( 'Promotion Tag : %s', 'twentytwelve' ), '<span>' . $queried_object->name . '</span>' );
                            break;
                    }

                    if( is_home() ) {
                        $page_id = get_option( 'page_for_posts' );
                        echo get_the_title( $page_id );
                    }
                        
                ?>    
                </h3>
            <?php endif; ?>
            <div class="site-wrap">
                <aside id="product-categories">
                    <div class="widget-title">
                            <h3><?php _e( 'Categories', 'woocommerce' ); ?></h3>
                        </div>
                    <div class="widget">
                        
                    <?php
                    
                        global $wp_query, $post;
                        
                        require_once 'jrl-walker.php';
                    
                        $cat_args = array(
                            'show_count'        => 0,
                            'taxonomy'          => 'product_cat',
                            'title_li'          => '',
                            'show_option_none'  => __('No product categories exist.', 'woocommerce' ),
                            'walker'            => new Jrl_Walker(),
                        );
                        
                        $current_cat = false;
			$cat_ancestors = array();
                        
                        if( is_tax('product_cat') ) {
                            $current_cat = $wp_query->queried_object;
                            $cat_ancestors = get_ancestors( $current_cat->term_id, 'product_cat' );
                            
                        } elseif( is_singular('product') ) {
                            $product_category = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );
                            if ( $product_category ) {
				$current_cat   = end( $product_category );
				$cat_ancestors = get_ancestors( $current_cat->term_id, 'product_cat' );
                            }
                        }
                        
                        $cat_args['current_category']	= ( $current_cat ) ? $current_cat->term_id : '';
			$cat_args['current_category_ancestors']	= $cat_ancestors;
                        
                        echo '<ul class="jrl-product-categories">';

			wp_list_categories( apply_filters( 'webtoko_product_categories_widget_args', $cat_args ) );

			echo '</ul>';
                        
                    ?>
                    </div>
                </aside><!-- #product-categories -->