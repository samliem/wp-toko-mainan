<?php

class jrl_Promo_Categories extends WP_Widget {
    
    function jrl_Promo_Categories() {
        $widget_ops = array(
            'classname'     => 'jrl-promo-categories',
            'description'   => 'Widget ini digunakan untuk menampilkan daftar kategori promosi'
        );
        $this->WP_Widget('jrl-promo-categories', 'Daftar Kategori Promosi', $widget_ops);
    }
    
    function form($instance) {
        $defaults = array('title' => 'Daftar Kategori Promosi');
        $instance = wp_parse_args($instance, $defaults); 
        $title = $instance['title']; ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?> ">Title</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo $title; ?>" class="widefat" />
        </p>
            
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        return $instance;
    }
    
    function widget($args, $instance) {
        extract($args);
        
        echo $before_widget;
        $title = apply_filters('jrl_promo_categories', $instance['title']);
        if( !empty($title) ) echo $before_title . $title . $after_title;
        
        $args = array('show_count'=> 1, 'title_li'=> '', 'taxonomy'=> 'kategori-promosi');
        echo '<ul>';
        wp_list_categories($args);
        echo '</ul>';
        
        echo $after_widget;
    }
    
}

?>
