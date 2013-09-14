<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action('jrl_before_single_promo'); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="entry-content">
        <?php if( has_post_thumbnail() ) : 
            $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $thumb_url = $post_thumbnail[0];
            $width = $post_thumbnail[1];
            $height = $post_thumbnail[2]; 
            
            echo sprintf( '<div class="promo-thumbnail"><a href="#" width="%d" height="%d" class="lightbox">
                <img src="%s" /></a></div>', $width, $height, $thumb_url );
        
            endif; 
        the_content(); ?>
    </div><!-- .entry-content -->
    
    <div class="posted_in promosi">
        <?php echo get_the_term_list(get_the_ID(), 'promo_cat', 'Kategori Promosi : ', ', '); ?>
    </div>
    
    <?php do_action('jrl_after_single_promo'); ?>
    
</article><!-- #post -->
