<?php

class jrl_YM_Widget extends WP_Widget {
        
        function jrl_YM_Widget() {
            $widget_ops = array(
                'classname'=> 'jrl-ym', 
                'description'=> 'YM Status Widget'
            );
            $this->WP_Widget('jrl-ym-widget', 'YM Online Status', $widget_ops);
        }
        
        function form($instance) {
            $default = array(
                'title'=> '',
                'ym_id'=> '',
                'ym_icon_no'=> 3
            );
            
            $instance = wp_parse_args( (array)$instance, $default );
            $title = $instance['title'];
            $ym_id = $instance['ym_id'];
            $ym_icon_no = $instance['ym_icon_no']; ?>
        
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Title :</label>
                <input type="text" class="widefat"
                    id="<?php echo $this->get_field_id('title'); ?>" 
                    name="<?php echo $this->get_field_name('title'); ?>"
                    value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('ym_id'); ?>">Yahoo ID :</label>
                <input type="text" class="widefat"
                    id="<?php echo $this->get_field_id('ym_id'); ?>"
                    name="<?php echo $this->get_field_name('ym_id'); ?>"
                    value="<?php echo $ym_id; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('ym_icon_no'); ?>">YM Icon no:</label>
                <input type="text" size="10"
                    id="<?php echo $this->get_field_id('ym_icon_no'); ?>"   
                    name="<?php echo $this->get_field_name('ym_icon_no'); ?>"
                    value="<?php echo $ym_icon_no; ?>" /> 
                <div class="description">
                    Contoh pengisian : 12 <br />
                    Daftar nomor YM icon ada 
                    <a href="http://www.macfamous.com/25-jenis-gambar-icon-status-yahoo-messenger.html"
                       target="_blank">
                       disini  
                    </a>
                </div>
            </p>
        <?php }
        
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['ym_id'] = strip_tags($new_instance['ym_id']);
            if( is_numeric($new_instance['ym_icon_no']) ) {
                if( $new_instance['ym_icon_no'] < 0 ) 
                    $instance['ym_icon_no'] = 3;
                else 
                    $instance['ym_icon_no'] = $new_instance['ym_icon_no'];
            } else {
                $instance['ym_icon_no'] = 3;
            }
            
            return $instance;
        }
        
        function widget($args, $instance) {
            extract( $args );
            
            $title = apply_filters('ym_widget_title', $instance['title']);
            $ym_id = $instance['ym_id'];
            $ym_icon_no = $instance['ym_icon_no'];
            
            echo $before_widget;
            if( !empty($instance['title']) )
                echo $before_title . $title . $after_title; ?>
            <a href="msgr:sendim?<?php echo $ym_id; ?>">
                <img src="http://opi.yahoo.com/online?u=<?php echo $ym_id; ?>&m=g&t=<?php echo $ym_icon_no; ?> border=0">
            </a>
        <?php 
            echo $after_widget;
        }
    }
?>