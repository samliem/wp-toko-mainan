<?php

/**
 * Knowledgebase Tag Cloud Widget
 *
 * @author 	IT Otto Dept
 * @category 	Widgets
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jrl_Promotion_Tag_Cloud extends WP_Widget {
    
    function jrl_Promotion_Tag_Cloud() {
        $widget_ops = array(
                    'classname'     => 'widget_promo_tag',
                    'description'   => 'Display All Promotion Tags'
                );
        $this->WP_Widget( 'promo_tag', __( 'Promotion Tag Cloud', 'twentytwelve' ), $widget_ops );
    }
    
    function form($instance) {
        $defaults = array( 'title' => __( 'Promotion Tag Cloud', 'twentytwelve' ) );
        
        $instance = wp_parse_args( (array)$instance, $defaults );
        $title = $instance['title']; ?>

        <p>
            <label for="widget-title"><?php _e( 'Title', 'twentytwelve' ); ?></label>
            <input type="text" id="widget-title" class="widefat" value="<?php echo esc_attr($title); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>"  >
        </p>
        
    <?php }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags( $new_instance['title'] ) ;
        
        return $instance;
    }
    
    function widget($args, $instance) {
        
        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        $taxonomies = get_terms('promo_tag', 'hierarchical=0');

        echo $before_widget;
        if( !empty( $instance['title'] ) ) 
            echo $before_title . $title . $after_title; ?>
        
        <ul id="promo-tag-cloud">
        <?php foreach( $taxonomies as $taxonomy ) : ?>
            <li>
                <a href="<?php echo get_term_link( $taxonomy, 'promo_tag' ); ?>">
                    <?php echo $taxonomy->name; ?>
                    <span><?php echo $taxonomy->count; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
            
        <?php echo $after_widget;
        
     }
}

?>
