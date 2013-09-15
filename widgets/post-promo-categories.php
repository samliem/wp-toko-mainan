<?php

class jrl_Post_Promo_Categories extends WP_Widget {
    
    function jrl_Post_Promo_Categories() {
        $widget_ops = array(
                    'classname'     => 'post-promo-categories',
                    'description'   => 'Menampilkan Promosi Dalam Kategori yang Dipilih'
                );
        $this->WP_Widget('post-promo-categories', 'Promosi Berdasarkan Kategori', $widget_ops);
    }
    
    function form($instance) {
        $instance = (array)$instance;
        if( empty($instance['title']) ) $instance['title'] = 'Daftar Kategori';
        $selected_categories = $instance['category']; ?>
        <p>
            Title
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo $instance['title']; ?>" class="widefat" />
        </p>
        <p>
            <?php
                $categories = get_terms('kategori-promosi');
                //var_dump($categories);
                foreach($categories as $category) : ?>
                    <div>
                        <input type="checkbox" name="<?php echo $this->get_field_name('category') . '[]'; ?>"
                            value="<?php echo $category->term_id; ?>"
                            <?php 
                            if( is_array($instance['category']) ) { 
                               if(in_array($category->term_id, $instance['category']) ) 
                               echo ' checked'; 
                            } ?>>
                        <?php echo $category->name; ?>
                    </div>
                <?php endforeach;
            ?>
        </p>
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = $new_instance['category'];
        
        return $instance;
    }
    
    function widget($args, $instance) {
        extract($args);
        
        echo $before_widget;
        $title = apply_filters('jrl_promo_categories_widget_title', $instance['title']);
        if( !empty($title) ) echo $before_title . $title . $after_title;
        
        if( is_array($instance['category']) ) : 
            $args = array(
                'post_type' => 'promosi',
                'tax_query' => array(
                            array(
                                'taxonomy'  => 'kategori-promosi',
                                'field'     => 'id',
                                'terms'     => $instance['category']
                            )
                    )
            );
            
            $query = new WP_Query( $args );
            
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
        endif; 
        
        echo $after_widget;
        
    }
}
?>
