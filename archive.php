<?php

/* replace parent's archive.php
 * 1. add <div class="content-wrap">
 * 2. conditional statement untuk cek apakah archive adalah taxonomy atau bukan
 */

get_header(); ?>

	<section id="primary" class="site-content">
            <div class="content-wrap"><!-- modification -->
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

                            //modification
                            if( is_tax('kategori-promosi') ) 
                                get_template_part( 'promosi', 'archive' );
                            else  
                        	get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
            </div><!-- content-wrap -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>