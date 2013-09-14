jQuery(document).ready(function($){
          
    var uploadSlideImgNo = 0;
    
    $('#add-slide').click(function(e){
        lastSlider = $('#num-of-slider').val();
        
        //-- Cek jika slide terakhir belum di upload gambarnya
        var slideUrlId = $('#slider-url_' + (lastSlider-1).toString());
        if( slideUrlId.val() == '') {
            alert('Gambar tidak boleh kosong');
            $('#slider-thumbnail_' + (lastSlider-1).toString())
                .addClass('slider-thumbnail-no-image');
            return false;
        }
        
        //-- Create slide berdasarkan template yang sudah disediakan
        var newSlide = $('.template').clone().removeClass('template')
            .addClass('slider')
            .attr('id', 'slider_' + lastSlider);
            
        console.debug('last slider:' + lastSlider);
            
        $('.slider-no', newSlide).html('Slider No : ' + (parseInt(lastSlider)+1));
        $('.slider-url', newSlide).attr('id', 'slider-url_' + lastSlider);
        $('.slider-thumbnail', newSlide).attr('id', 'slider-thumbnail_' + lastSlider);
        
        $('.upload-slider-img', newSlide).attr('id', 'upload-slider-img_' + lastSlider);
        $('.upload-slider-img', newSlide).on('click', function() {
            uploadThumbnail($(this));
        });
        
        $('.delete-slider', newSlide).attr('id', 'del_' + lastSlider);    
        $('.delete-slider', newSlide).on('click', function(e){
            delSlider($(this));
            e.preventDefault();
        });
        
        $('#sliders').append(newSlide);
        
        $('#upload-slider-img_' + lastSlider).focus();
        
        lastSlider = parseInt(lastSlider) + 1;
        $('#num-of-slider').val(lastSlider);
        
        console.debug('Num of slider:' + $('#num-of-slider').val());
        
        e.preventDefault();
    });
    
    $('.upload-slider-img').click(function(){
        uploadThumbnail($(this));
    });
    
    function uploadThumbnail(src) {
        var uploadSliderImgId = src.attr('id').split('_');
        uploadSlideImgNo = uploadSliderImgId[1];
        $('#media-caller').val('slider-url_' + uploadSlideImgNo);
        console.debug('slide-url_' + uploadSlideImgNo );
        tb_show('Upload Gambar Slide', 'media-upload.php?referer=jrl-theme-settings&amp;type=image&amp;TB_iframe=true', false);
        return false;
    }
       
    $('.delete-slider').click(function(e){
        delSlider($(this));
        console.debug('Num of Slider:' + $('#num-of-slider').val());
        e.preventDefault();
    });
    
    function delSlider(src) {
        lastSlider = $('#num-of-slider').val();
        var slideId = src.attr('id').split('_');
        var slideNo = '#slider_' + slideId[1];
        var yesno = confirm('Slide ini akan dihapus ?');
        if( yesno ) {
            if( lastSlider > 0 ) {
                $(slideNo, '#sliders').remove();
                lastSlider -= 1;
                $('#num-of-slider').val(lastSlider);
                reindexSlideNo();
            }
        }
    }
    
    function reindexSlideNo() {
        $('.slider').each(function(index){
            console.debug('index : ' + index);
            $(this).attr('id', 'slider_' + index);
            $(this).find('.slider-no').text('Slider No : ' + (index+1));
            $(this).find('.slider-url').attr('id', 'slider-url_' + index);
            $(this).find('.slider-thumbnail').attr('id', 'slider-thumbnail_' + index);
            $(this).find('.upload-slider-img').attr('id', 'upload-slider-img_' + index);
            $(this).find('.delete').attr('id', 'del_' + index);
        });
    }
    
});


    
    
    
    