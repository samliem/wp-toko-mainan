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
    
    <footer class="entry-meta">
	<?php twentytwelve_entry_meta(); ?>
	<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
        <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
            <div class="author-info">
                <div class="author-avatar">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
		</div><!-- .author-avatar -->
		<div class="author-description">
                    <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
                    <p><?php the_author_meta( 'description' ); ?></p>
                    <div class="author-link">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                            <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
                        </a>
                    </div><!-- .author-link	-->
		</div><!-- .author-description -->
            </div><!-- .author-info -->
	<?php endif; ?>
                                
        <div class="posted_in promosi">
            <?php echo get_the_term_list( get_the_ID(), 'promo_cat', '<div class="promo-cat">Posted in Category : ', ', ', '</div>' ); ?>
            <?php echo get_the_term_list( get_the_ID(), 'promo_tag', '<div class="promo-cat">Tags : ', ', ', '</div>' ); ?>
        </div>
            
    </footer><!-- .entry-meta -->
    
    <?php do_action('jrl_after_single_promo'); ?>
    
</article><!-- #post -->
