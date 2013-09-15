<?php

class jrl_Banner_Promo extends WP_Widget {
    
    function jrl_Banner_Promo() {
        $widget_ops = array(
                'classname'=> 'jrl-banner-promo',
                'description'=> 'Widget Untuk Memasang Banner Promosi'
            );
        $this->WP_Widget('jrl-banner-promo-widget', 'Banner Promosi', $widget_ops);
    }
    
    function form($instance) {
        $title = $instance['title'];
        $post_id = $instance['post_id']; ?>
        
        <p>
            <label for="widget-title">Judul Widget</label>
            <input type="text" class="widefat" id="widget-title"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="post-id">Post ID</label>
            <input type="text" id="post-id" name="<?php echo $this->get_field_name('post_id'); ?>"
                   value="<?php echo $post_id; ?>" size="5" />
        </p>
        
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_id'] = strip_tags($new_instance['post_id']);
               
        return $instance;
    }
    
    function widget($args, $instance) {
        
        extract($args);
        
        $title = apply_filters('promo_banner_title', $instance['title']);
        $post_id = $instance['post_id'];
        
        echo $before_widget;
        if( !empty($title) ) {
            echo $before_title . $title . $after_title;
        } 
        
        if( !empty($post_id) ) : 
            $img_src = get_the_post_thumbnail($post_id, 'medium');?>
            <a id="banner-promo" href="<?php echo get_permalink($post_id); ?>">
                <?php if( empty($img_src) ) :
                    echo '<h2>' . get_the_title($post_id) . '</h2>';
                else : 
                    echo $img_src;
                endif; ?>
            </a>
        <?php endif;       
        
        echo $after_widget;
    }
    
}

?>