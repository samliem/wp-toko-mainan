<?php

/*
 * This class is for displaying Store Information,
 * such as address, phone number, etc
 */

class Jrl_Store_Info extends WP_Widget {
    
    function Jrl_Store_Info() {
        $widget_ops = array(
                'class'         => 'store-info',
                'description'   => 'Widget ini digunakan untuk menampilkan informasi toko'
            );
        $this->WP_Widget( 'store-info-widget', __( 'Store Information', 'twentytwelve' ), $widget_ops );
    }
    
    function form($instance) {
        $default = array( 'title'=> __( 'Store Information', 'woocommerce' ) );
        $instance = wp_parse_args( $instance, $default );
        $title = $instance['title']; ?>
        
        <p>
            <label for="widget-title"><?php _e( 'Title', 'twentytwelve' ); ?></label>
            <input id="widget-title" class="widefat" value="<?php echo $title; ?>"
                name="<?php echo $this->get_field_name('title'); ?>" >
        </p>
        
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }
    
    function widget($args, $instance) {
        extract($args);
                
        echo $before_widget;
        $title = apply_filters( 'title', $instance['title'] );
        if( !empty( $title ) ) echo $before_title . $title . $after_title;
        
        $jrl_theme_options = get_option( 'jrl_theme_options' );
        
        if( !empty($jrl_theme_options['address1']) ) 
            echo '<div>' . $jrl_theme_options['address1'] . '</div>';
                    
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
        
        echo $after_widget;
    }
    
}
?>
