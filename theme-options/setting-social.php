<form id="setting-social" method="post" action="options.php" 
    <?php if( 'social' != $_COOKIE['jrl_theme_tab'] ) echo 'class="hide"'; ?>>
    <?php 
        global $jrl_theme_options; 
        settings_fields('jrl_theme_options');
    ?>
    <input type="hidden" name="tab" value="social"/>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <label for="facebook-url">Facebook</label>
            </th>
            <td>
                <input type="text" id="facebook-url" name="jrl_theme_options[facebook]"
                    size="50" value="<?php echo $jrl_theme_options['facebook']; ?>" />
                <span class="description">Contoh : http://www.facebook.com/tutorialwebsite.org</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <label for="twitter-url">Twitter</label>
            </th>
            <td>
                <input type="text" id="twitter-url" name="jrl_theme_options[twitter]"
                    size="50" value="<?php echo $jrl_theme_options['twitter']; ?>" />
                <span class="description">Contoh : https://twitter.com/tut0r14lwebsite</span>
            </td>
        </tr>
    </table> 
    <div class="simpan">
        <input type="submit" value="Simpan" class="button-primary" />
    </div>
</form>
