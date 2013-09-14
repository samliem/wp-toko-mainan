jQuery(document).ready(function($){
    
    window.send_to_editor = function(html) {
        var image_url = $('img', html).attr('src');
        tb_remove();
        
        var caller = $('#media-caller').val();
        if( caller.search('slider') == -1 ) {
            if( caller == 'upload-logo-button' ) {
                $('#logo-url').val(image_url);
                $('#logo-preview img').attr('src', image_url).show();
                $('.description', '#logo-preview').hide();
                $('#logo-delete').show();
            }

            if( caller == 'upload-favicon-button' ) {
                $('#favicon').val(image_url);
                $('#favicon-preview img').attr('src', image_url).show();
                $('.description', '#favicon-preview').hide();
                $('#favicon-delete').show();
            }
        } else {
            $('#' +caller).val(image_url);
            var slideNo = caller.split('_');
            var sliderThumbnailId = '#slider-thumbnail_' + slideNo[1];
            $('img', sliderThumbnailId).attr('src', image_url);
            $(sliderThumbnailId).removeClass('slider-thumbnail-no-image');
        }
    };
    
});



