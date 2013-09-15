<?php

class jrl_Recent_Promo extends WP_Widget {
    
    function jrl_Recent_Promo() {
        $widget_ops = array(
                    'class'         => 'jrl-recent-promo',
                    'description'   => 'Widget ini digunakan untuk menampilkan promo-promo terbaru',
                );
        $this->WP_Widget('jrl-recent-promo-widget', 'Promo Terbaru', $widget_ops);
    }
    
    function form($instance) {
        $default = array(
                    'title'     => 'Promosi Terbaru',
                    'max_posts' => 5
                );
        $instance = wp_parse_args($instance, $default);
        $title = $instance['title'];
        $max_posts = $instance['max_posts']; ?>
        
        <p>
            <label for="widget-title">Title </label>
            <input id="widget-title" class="widefat"
                name="<?php echo $this->get_field_name('title'); ?>"
                value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="max-posts">Max. Promo : </label>
            <input id="max-posts" value="<?php echo $max_posts; ?>"
                name="<?php echo $this->get_field_name('max_posts'); ?>" />
        </p>
        
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        if( is_numeric($new_instance['max_posts']) ) {
            if( $new_instance['max_posts'] < 1 ) 
                $instance['max_posts'] = 5;
            else
                $instance['max_posts'] = $new_instance['max_posts'];
        } else {
            $instance['max_posts'] = 5;
        }
        
        return $instance;
    }
    
    function widget($args, $instance) {
        
        extract($args); 
        
        echo $before_widget;
        $title = apply_filters('jrl_recent_promo_widget_title', $instance['title']);
        
        if( !empty($title) ) 
            echo $before_title . $title . $after_title;
        
        $args = 
            array(
                'posts_per_page'    => $instance['max_posts'],
                'post_type'         => 'promosi',
                'post_status'       => 'publish',
            );
        
        $query = new WP_Query($args);
        //var_dump($query->posts);
 
        if( count($query->posts) > 0 ) {
            echo '<ul class="list-promo">';
            foreach ($query->posts as $post) : ?>
                <li>
                    <div class="promo-thumbnail">
                            <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
                        </div>
                        <h2><?php echo $post->post_title; ?></h2>
                    <a href="<?php echo get_permalink($post->ID); ?>">
                        
                        <div style="clear: right"><?php echo wp_trim_words($post->post_content, 10, '  &rarr;'); ?></div>
                    </a>
                </li>
            <?php endforeach;
            echo '</ul>';
            
            wp_reset_postdata();
        }
        
        echo $after_widget;
    }
    
}

?>
