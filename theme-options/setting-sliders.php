<form id="setting-slider" method="post" action="options.php" enctype="multipart/form-data"
    <?php if( 'slider' != $_COOKIE['jrl_theme_tab'] ) echo 'class="hide"'; ?>>
    <a href="#" id="add-slide" class="jrl-button add">Tambah Slide</a>
    <div id="sliders">
    <?php 
    settings_fields('jrl_theme_options'); 
    global $jrl_theme_options;
    $sliders_url = isset($jrl_theme_options['slider_img']) ? true : false;
    $num_of_slider = $sliders_url ? count( $jrl_theme_options['slider_img'] ) : 1; ?>
    <input type="hidden" id="num-of-slider" value="<?php echo $num_of_slider; ?>" />
    <?php if( $sliders_url ) :
        for( $i = 0; $i < $num_of_slider; $i++) : ?>
            <div id="slider_<?php echo $i; ?>" class="slider">
                <div class="slider-no">
                    Slider No. : <?php echo $i+1; ?>
                </div>
                <div class="tb-cell slider-img">
                    <input type="hidden" id="slider-url_<?php echo $i;?>" class="slider-url" 
                        name="jrl_theme_options[slider_img][]" 
                        value="<?php echo $jrl_theme_options['slider_img'][$i]; ?>" />
                    <div id="slider-thumbnail_<?php echo $i; ?>" class="slider-thumbnail">
                        <img src="<?php echo $jrl_theme_options['slider_img'][$i]; ?>" />
                    </div>
                    <div class="button-slider">
                        <input type="button" id="upload-slider-img_<?php echo $i; ?>" 
                            class="button-secondary upload-slider-img" value="Upload"
                            title="Upload gambar slider"/>&nbsp;
                    </div>
                </div>
                <div class="tb-cell">
                    <div>
                        <label for="slider-post-id" size="10">Post ID : </label>
                        <input type="text" id="slider-post-id" name="jrl_theme_options[slider_post][]" 
                            value="<?php echo $jrl_theme_options['slider_post'][$i]; ?>"/>
                    </div>
                    <div>
                        <label for="slider-title" size="10">Judul :</label>
                        <input type="text" id="slider-title" name="jrl_theme_options[slider_title][]" 
                            value="<?php echo $jrl_theme_options['slider_title'][$i]; ?>"/>
                    </div>
                    <div class="slider-add-delete">
                        <a href="#" id="del_<?php echo $i; ?>" class="jrl-button delete delete-slider">
                            Hapus Slide
                        </a>
                    </div>
                </div>
            </div>
         <?php endfor; 
    else: ?>
        <div id="slider_0" class="slider">
            <div class="slider-no">
                    Slider No. : 1
            </div>
            <div class="tb-cell slider-img">
                <input type="hidden" id="slider-url_0" class="slider-url" name="jrl_theme_options[slider_img][]" value="" />
                <div id="slider-thumbnail_0" class="slider-thumbnail">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/theme-options/css/images/no_picture.gif';?>" />
                </div>
                <div class="button-slider">
                    <input type="button" id="upload-slider-img_0" 
                        class="button-secondary upload-slider-img" 
                        value="Upload" title="Upload gambar slider" />
                </div>
            </div>
            <div class="tb-cell">
                <div>
                    <label for="slider-post-id" size="10">Post ID : </label>
                    <input type="text" id="slider-post-id" name="jrl_theme_options[slider_post][]" />
                </div>
                <div>
                    <label for="slider-title" size="10">Judul :</label>
                    <input type="text" id="slider-title" name="jrl_theme_options[slider_title][]" />
                </div>
                <div class="slider-add-delete">
                    <a href="#" id="del_0" class="jrl-button delete delete-slider">
                        Hapus Slide
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <div class="simpan">
        <input type="submit" value="Simpan" class="button-primary" />
    </div>
</form>
<div class="template">
    <div class="slider-no"></div>
    <div class="tb-cell slider-img">
        <input type="hidden" class="slider-url" name="jrl_theme_options[slider_img][]" 
            value="" />
        <div class="slider-thumbnail">
            <img src="<?php echo get_stylesheet_directory_uri() . '/theme-options/css/images/no_picture.gif';?>" />
        </div>
        <div class="button-slider">
            <input type="button" class="button-secondary upload-slider-img" value="Upload"
                title="Upload gambar slider"/>
        </div>
    </div>
    <div class="tb-cell">
        <div>
            <label for="slider-post-id" size="10">Post ID : </label>
            <input type="text" id="slider-post-id" name="jrl_theme_options[slider_post][]" />
        </div>
        <div>
            <label for="slider-title" size="10">Judul :</label>
            <input type="text" id="slider-title" name="jrl_theme_options[slider_title][]" />
        </div>
        <div class="slider-add-delete">
            <a href="#" class="jrl-button delete delete-slider">
                Hapus Slide
            </a>
        </div>
    </div>
</div>
