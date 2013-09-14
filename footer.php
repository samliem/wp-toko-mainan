<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
            </div><!-- .site-wrap -->
	</div><!-- #main .wrapper -->
        <?php global $jrl_theme_options;?>
	<footer id="colophon" role="contentinfo">
            <div class="footer-top">
                <div class="site-wrap">
                    <div class="phone-store">Tel.: <?php echo $jrl_theme_options['phone']; ?>
                        
                    </div><!-- resto-name
                     --><div class="store-notice">
                         <?php 
                            $store_notice = get_option( 'woocommerce_demo_store' );
                            if( $store_notice !== 'no') 
                                _e( get_option( 'woocommerce_demo_store_notice'), 'woocommerce' );
                         ?>
                    </div><!-- store-container
                     --><div class="social-container">
                        <?php if( !empty($jrl_theme_options['facebook']) ) : ?>
                            <a href="<?php echo $jrl_theme_options['facebook'];?>" class="social facebook" alt="follow my facebook"></a>
                        <?php endif; 

                        if( !empty($jrl_theme_options['twitter']) ) : ?>
                            <a href="<?php echo $jrl_theme_options['twitter'];?>" class="social twitter" alt="follow my twitter"></a>
                        <?php endif; ?>
                    </div><!-- social-container -->
                </div><!-- site-wrap -->
            </div><!-- footer-top -->
            <div class="site-wrap">
                <div class="widget-footer-container">
                <div class="store-info widget">
                    <h3>
                        <?php echo apply_filters( 'informasi_alamat', '<span>Informasi</span>&nbsp; Alamat' ); ?>
                    </h3>
                    <?php
                    if( !empty($jrl_theme_options['address1']) ) {
                        echo '<div>' . $jrl_theme_options['address1'] . '</div>';
                    }

                    if( !empty($jrl_theme_options['address2']) ) {
                        echo '<div>' . $jrl_theme_options['address2'] . '</div>';
                    }

                    if( !empty($jrl_theme_options['address3']) ) {
                        echo '<div>' . $jrl_theme_options['address3'] . '</div>';
                    }
                    
                    if( !empty($jrl_theme_options['phone']) ) {
                        echo '<div> Phone : ' . $jrl_theme_options['phone'] . '</div>';
                    }
                    
                    if( !empty($jrl_theme_options['fax']) ) {
                        echo '<div> Fax. : ' . $jrl_theme_options['fax'] . '</div>';
                    }
                    
                    if( !empty($jrl_theme_options['bbm']) ) {
                        echo '<div>Pin BB : ' . $jrl_theme_options['bbm']. '</div>';
                    } 
                    ?>
                </div><!-- store-info 
                --><div class="widget-footer">
                    <?php if( function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-4') ) : 
                        dynamic_sidebar('sidebar-4'); 
                    endif; ?>
                </div><!-- widget-footer
                --><div class="widget-footer">
                    <?php if( function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-5') ) : 
                        dynamic_sidebar('sidebar-5'); 
                    endif; ?>
                </div><!-- widget-footer -->
                
                </div>
            </div><!-- site-wrap -->
            <div class="site-wrap">
                <div id="copyright">
                    Copyright &copy;<?php echo date('Y'); ?>
                    <a href="<?php home_url(); ?>"><?php bloginfo('name'); ?></a>
                </div>
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>