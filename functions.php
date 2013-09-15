<?php

/*************************************************************
********************** Initialization ***********************/

require_once( 'theme-options/theme-options.php' );
define( 'THEME_OPTION', 'jrl_theme_options');
$GLOBALS['jrl_theme_options'] = get_option( THEME_OPTION );    //global variable
    
/**
 * Register footer sidebar
 */
function jrl_footer_sidebar() {
    register_sidebar( array(
        'name'          => 'Footer Widget Area Center',
        'id'            => 'sidebar-4',
        'description'   => 'Digunakan untuk meletakkan widget di dalam footer di bagian tengah. Disarankan hanya 1 buah widget',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
        
    register_sidebar( array(
        'name'          => 'Footer Widget Area Right',
        'id'            => 'sidebar-5',
        'description'   => 'Digunakan untuk meletakkan widget di dalam footer di bagian kanan. Disarankan hanya 1 buah widget',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'jrl_footer_sidebar' );
    
/**
 * Lightbox function
 */
function jrl_insert_mask() { ?>
    <div id="mask" class="hide">
        <div class="lightbox-container">
            <a href="#" id="lightbox-close" title="close">
                <img src="<?php echo get_stylesheet_directory_uri() . '/images/cancel.png'; ?>" />
            </a>
            <img class="lightbox-image" src="" />
        </div>
    </div><!-- #mask -->
<?php } 
add_action('jrl_before_header', 'jrl_insert_mask');
    
/**
 * Insert scrolling up link
 */
function jrl_back_to_top() { ?>
    <a id="back-to-top" href="" title="back to top">^</a>
<?php } 
add_action('jrl_before_header', 'jrl_back_to_top');

/*************************************************************
*********************** head section ************************/
/**
 * Insert font link in the head section
 * 
 * @return void
 */
function jrl_theme_font_link() {
    echo '<link href="http://fonts.tutorialwebsite.org/fonts.css" rel="stylesheet" type="text/css" />';
    echo '<link href="http://fonts.googleapis.com/css?family=Devonshire|Didact+Gothic" rel="stylesheet" type="text/css">';
}  
add_action( 'theme_font', 'jrl_theme_font_link', 30 );
    
/**
 * Insert link with attribut rel into head section
 * 
 * @global type $jrl_theme_options
 */
function jrl_theme_links() { ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
        global $jrl_theme_options;
        if( !empty($jrl_theme_options['favicon']) ) : ?>
            <link rel="shortcut icon" href="<?php echo $jrl_theme_options['favicon']; ?>" 
                type="image/x-icon" />
    <?php endif; 
}
add_action( 'theme_links', 'jrl_theme_links' );

/**
 * Insert meta tag into head section
 * 
 */
function jrl_theme_meta() { ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
<?php }
add_action( 'theme_meta', 'jrl_theme_meta' );
    
/**
 * Insert scripts into head section
 */
function jrl_theme_script() {
  wp_enqueue_script( 'widget-footer-script', 
                get_stylesheet_directory_uri() . '/js/widgetfooter-title-style.js', 
                array('jquery') );
        
  wp_enqueue_script( 'main',
                get_stylesheet_directory_uri() . '/js/main.js',
                array('jquery') );
  
  wp_enqueue_script( 'product-category',
                get_stylesheet_directory_uri() . '/js/product-category.js',
                array('jquery') );
        
  wp_enqueue_style( 'contact-form7-style', 
                get_stylesheet_directory_uri() . '/css/contact-form7.css' );
}
add_action( 'wp_head', 'jrl_theme_script' );

/*************************************************************
*********************** Navigation **************************/

/**
 * Menambah class menu-parent untuk setiap menu yang memiliki sub menu
 * 
 * @param type $sorted_menu_items
 * @param type $args
 * @return type
 */
function add_menu_parent_class( $sorted_menu_items, $args ) {
    
    $parent_items = array();
    
    foreach( $sorted_menu_items as $item) {
        if( $item->menu_item_parent != '0')
            $parent_items[] = $item->menu_item_parent;
    }
    
    foreach ( $sorted_menu_items as $item) {
        if( in_array($item->ID, $parent_items) ) 
            $item->classes[] = 'menu-parent';   
    }
    
    return $sorted_menu_items;

}
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class', 10, 2 );

/*************************************************************
******* Js untuk upload image menggunakan media upload ******/
    
/**
 * Activate media upload
 * 
 * @param type $hook
 */
function jrl_image_uploader($hook) {
    if( 'appearance_page_theme-options' == $hook) {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
}
add_action('admin_enqueue_scripts', 'jrl_image_uploader');

/*************************************************************
 ************* Add Metabox for Special Offering *************/ 

/**
 * Add a metabox when Add / Edit a product
 * The metabox is used to entry special offering or product promotion
 * 
 * @return void
 */
function add_product_promo_metabox() {
    add_meta_box( 'promo-metabox', __( 'Special Offerings and Product Promotion', 'woocommerce'), 'single_product_promo', 'product', 'normal', 'low' );
}
add_action( 'add_meta_boxes', 'add_product_promo_metabox' );  
   
/**
 * Single Product Promo / Offerings editor
 * This callback of add_meta_box with id promo-metabox
 *
 * @return void
 */
function single_product_promo( $post ) {
    wp_nonce_field( basename( __FILE__), 'product_promo_metabox' );
    $content = get_post_meta( $post->ID, '_product_promo', true );
    $settings = array(
        'quicktags'         => array( 'buttons' => 'em,strong,link' ),
        'textarea_name'     => 'product_promo',
        'quicktags'         => true,
        'tinymce'           => true,
        'editor_css'        => '<style>#wp-product_promo-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
    );
    wp_editor( htmlspecialchars_decode( $content ), 'product_promo', $settings);
}

/**
 * Capture product promo
 * 
 * Hook : save_post
 * 
 * @return void
 */
function save_product_promo($post_id) {
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if( ! isset( $_POST['product_promo_metabox'] ) || ! wp_verify_nonce( $_POST['product_promo_metabox'], basename( __FILE__ ) ) ) return;
    
    if ( ! current_user_can( 'edit_post', $post_id ) )  return;
    
    if( isset( $_POST['product_promo'] ) ) 
        update_post_meta ($post_id, '_product_promo', $_POST['product_promo'] );
}
add_action( 'save_post', 'save_product_promo' );

/**
 * Insert admin style for product promotion metabox
 * 
 * Hook : admin_init
 * @return void
 */
function webtoko_add_admin_css() {
    wp_enqueue_style( 'admin-css', get_stylesheet_directory_uri() . '/admin.css' );
}
add_action( 'admin_init', 'webtoko_add_admin_css' );

/*********************************************************************
 ******************* Replacing Parent's functions *******************/

/**
 * Replace parent's function for adjustsing content_width value for full-width and 
 * single image attachment templates, and when there are no active widgets in the sidebar. 
 * 
 * @global int $content_width
 */
function webtoko_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 987;
	}
}
add_action( 'template_redirect', 'webtoko_content_width' );

/*********************************************************************
 *************************** WooCommerce ****************************/

/**
 * Include home-slider.php if current page is front page
 * along with home slider script and style
 */
function add_homepage_slider() {
    if( is_front_page() ) { 
        //add_filter('woocommerce_show_page_title', 'hide_wc_page_title');
        wp_enqueue_script( 'home-slider-script', get_stylesheet_directory_uri() . '/js/slider.js', false, true );
        wp_enqueue_style( 'home-slider-style', get_stylesheet_directory_uri() . '/css/home.css' );
        get_template_part( 'home', 'slider' );
    }
}
add_action( 'woocommerce_before_main_content', 'add_homepage_slider' );

/**
 * Replace woocommerce's output related products function
 * Display 3 colums in 2 rows
 */
function woocommerce_output_related_products() {
    woocommerce_related_products( 3, 2 );
}

/**
 * Removing Product Title dan
 * Mengubah urutan antara harga dan short description
 */
function remove_product_title() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
}
add_action( 'after_setup_theme', 'remove_product_title' );

function hide_product_category_title($is_show) {
    $is_show = false;
    return $is_show;
}
add_filter( 'woocommerce_show_page_title', 'hide_product_category_title' );

/*********************************************************************
 *************** Promo Custom Post Type and Taxonomy ****************/

/**
 * Register promo post type and promo taxonomy
 * 
 * @return type
 */
function jrl_register_promo_post_type() {
    if( post_type_exists( 'promo' ) )
        return;
    
    global $wp_rewrite;
            
    //only role Editor and above that can use custom post type
    $show_in_menu = current_user_can( 'publish_pages' ) ? true : false;
    
    $labels = array(
        'name'              => __( 'Promotions', 'twentytwelve' ),
        'singular_name'     => __( 'Promotion', 'twentytwelve' ),
        'menu_name'         => __( 'Promotions', 'twentytwelve' ),
        'all_items'         => __( 'All Promotions', 'twentytwelve' ),
        'add_new'           => __( 'Add Promotion', 'twentytwelve' ),
        'add_new_item'      => __( 'Add New Promotion', 'twentytwelve' ),
        'edit'              => __( 'Edit', 'twentytwelve' ),
        'edit_item'         => __( 'Edit Promotion', 'twentytwelve' ),
        'new_item'          => __( 'New Promotion', 'twentytwelve' ),
        'view'              => __( 'View', 'twentytwelve' ),
        'view_item'         => __( 'View Promotion', 'twentytwelve' ),
        'search_items'      => __( 'Search Promotions', 'twentytwelve' ),
        'not_found'         => __( 'No Promotions Found', 'twentytwelve' ),
        'not_found_in_trash'=> __( 'No Promotions Found in Trash', 'twentytwelve' ),
    );
        
    $supports = array( 'title', 'editor', 'author', 'thumbnail' );
    
    register_post_type('promo',
        array(
            'labels'                => $labels,
            'description'           => __( 'For creating promotion post', 'twentytwelve' ),
            'public'                => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => $show_in_menu,
            'show_in_nav_menus'     => false,
            'menu_position'         => 5,
            'hierarchical'          => true,
            'has_archive'           => true,
            'query_var'             => true,
            'supports'              => $supports,
        )
    );
    
    flush_rewrite_rules();
    
    $tax_cat_label = 
        array(
            'name'              => __( 'Promotion Categories', 'twentytwelve' ),
            'singular_name'     => __( 'Promotion Category', 'twentytwelve' ),
            'menu_name'         => __( 'Promotion Categories', 'twentytwelve' ),
            'search_items'      => __( 'Search Categories', 'twentytwelve' ),
            'all_items'         => __( 'All Categories', 'twentytwelve' ),
            'parent_item'       => __( 'Parent Category', 'twentytwelve' ),
            'parent_item_colon' => __( 'Parent Category : ', 'twentytwelve' ),
            'edit_item'         => __( 'Edit Promotion Category', 'twentytwelve' ),
            'update_item'       => __( 'Update Promotion Category', 'twentytwelve' ),
            'add_new_item'      => __( 'Add New Category', 'twentytwelve' ),
            'new_item_name'     => __( 'New Promotion Category Name', 'twentytwelve' ),
        );

    register_taxonomy( 'promo_cat', 'promo',
        array(
            'labels'            => $tax_cat_label,
            'public'            => true,
            'hierarchical'      => true,
            'query_var'         => true,
            'sort'              => true,
            'show_admin_column' => true,
            'rewrite'           => array( 
                                        'slug'          => 'promo-category',
                                        'with_front'    => false,
                                        'hierarchical'  => true
                                   )
        ));
    
    $wp_rewrite->flush_rules();

    $tax_tag_label = 
        array(
            'name'              => __( 'Promotion Tags', 'twentytwelve' ),
            'singular_name'     => __( 'Promotion Tag', 'twentytwelve' ),
            'menu_name'         => __( 'Promotion Tags', 'twentytwelve' ),
            'search_items'      => __( 'Search Tags', 'twentytwelve' ),
            'all_items'         => __( 'All Promotion Tags', 'twentytwelve' ),
            'parent_item'       => __( 'Parent Tag', 'twentytwelve' ),
            'parent_item_colon' => __( 'Parent Tag : ', 'twentytwelve' ),
            'edit_item'         => __( 'Edit Knowledgebase Tag', 'twentytwelve' ),
            'update_item'       => __( 'Update Knowledgebase Tag', 'twentytwelve' ),
            'add_new_item'      => __( 'Add New Tag', 'twentytwelve' ),
            'new_item_name'     => __( 'New Tag Name', 'twentytwelve' )
        );
    
    register_taxonomy( 'promo_tag', 'promo',
        array(
            'labels'                => $tax_tag_label,
            'public'                => true,
            'hierarchical'          => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_admin_column'     => true,
            'sort'                  => true,
            'rewrite'               => array( 
                                            'slug'          => 'promo-tag',
                                            'with_front'    => false
        )
    ));

}
add_action( 'init', 'jrl_register_promo_post_type' );

/**
 * Insert lightbox script for promo post type thumbnail
 * @param type $post
 */
function add_thumbnail_script($post) {
    if( $post->post_type == 'promo' )
        wp_enqueue_script('thumbnail', get_stylesheet_directory_uri() . '/js/thumbnail-lightbox.js', array('jquery'), false, true);
}
add_action( 'the_post', 'add_thumbnail_script');

/*********************************************************************
*************************** Custom Widget ***************************/    

/**
 * Register widget regarding promo post type and taxonomy
 * 
 */
function jrl_custom_widget() {
    wp_enqueue_style('widget-style', get_stylesheet_directory_uri() . '/widgets/css/widget.css');
        
    //require_once "widgets/ym.php";
    require_once "widgets/promo-banner.php";
    require_once "widgets/recent-promo.php";
    require_once "widgets/promo-categories.php";
    require_once "widgets/post-promo-categories.php";
        
    //register_widget('jrl_YM_Widget');
    register_widget('jrl_Banner_Promo');
    register_widget('jrl_Recent_Promo');
    register_widget('jrl_Promo_Categories');
    register_widget('jrl_Post_Promo_Categories');
}
add_action('widgets_init', 'jrl_custom_widget');

?>
