<?php
    global $jrl_theme_options;
?>
<div id="home-slider">
    <ul id="slider-list">
        <?php 
        $num_of_slider = count($jrl_theme_options['slider_img']);
        for( $i = 0; $i < $num_of_slider; $i++ ) : 
            $post_id = $jrl_theme_options['slider_post'][$i]; ?>
            <li id="slider-<?php echo $i; ?>" class="slide-item" >
                <a title="<?php echo $jrl_theme_options['slider_title'][$i]; ?>"
                    href="<?php echo empty( $post_id ) ? '' : get_permalink($post_id); ?>">
                    <img src="<?php echo $jrl_theme_options['slider_img'][$i]; ?>"
                        <?php if( $i > 0 ) echo 'class="hide"';?> />
                    <?php if( !empty($post_id) ) : ?>
                    <div class="slider-info">
                        <?php $the_post = get_post($post_id); ?>
                        <div id="slide-post-title-<?php echo $i; ?>" class="slide-post-title">
                            <?php echo $the_post->post_title; ?>
                        </div>
                        <div id="slide-post-excerpt-<?php echo $i; ?>" class="slide-post-excerpt">
                            <?php echo wp_trim_words($the_post->post_content, 20); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </a>
            </li>
        <?php endfor;?>
    </ul>
    <div id="slide-counter">
        <div id="inner-slide-counter">
        <?php 
        for( $i = 0; $i < $num_of_slider; $i++ ) : ?>
            <a id="slideno-<?php echo $i; ?>" href="#" 
                title="<?php echo $jrl_theme_options['slider_title'][$i]; ?>"
                class="slide-counter <?php if( $i == 0) echo 'selected-slide'; ?>">
                <?php echo $i+1; ?>
            </a>
        <?php endfor;?>
        </div>
    </div>
    <div id="slide-nav">
        <div class="slide-nav right">
            <a href="#"></a>
        </div>
        <div class="slide-nav left">
            <a href="#"></a>
        </div>
    </div>
</div>
<div class="callout border-callout hide">
    <div class="callout-content"></div>
    <div class="border-notch notch"></div>
    <div class="notch"></div>
</div>            
            

