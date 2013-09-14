jQuery(document).ready(function($){
    
    /********************************* LOGO **********************************/
    $('#upload-logo-button').click(function(){
        $('#media-caller').val('upload-logo-button');
        tb_show('Upload Gambar Logo', 'media-upload.php?referer=jrl-theme-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
        return false;
    });
    
    $('#delete-logo-button').click(function(){
        var yesno = confirm('Anda yakin akan menghapus logo ini?');
        if( yesno ) {
            $('#logo-url').val('');
            $('#logo-preview img').hide();
            $('.description', '#logo-preview').show();
            $('#logo-delete').hide();
        }
    });
    
    $('.submit', 'form#setting-general').click(function(){
       var logoType = $('#rbText').is(':checked') ? 'text' : 'gambar'; 
       
       if( logoType === 'gambar' && $('#logo-url').val() === '' ) {
           alert('Gambar logo tidak boleh kosong');
           $('#upload-logo-button').focus();
           return false;
       }
       
    });
    
    /******************************** FAVICON ********************************/
    $('#upload-favicon-button').click(function(){
        $('#media-caller').val('upload-favicon-button');
        tb_show('Upload Gambar Favicon', 'media-upload.php?referer=jrl-theme-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
        return false;
    });
    
    $('#delete-favicon-button').click(function(){
        var yesno = confirm('Anda yakin akan menghapus favicon ini?');
        if( yesno ) {
            $('#favicon').val('');
            $('#favicon-preview img').hide();
            $('.description', '#favicon-preview').show();
            $('#favicon-delete').hide();
        }
    });
});


