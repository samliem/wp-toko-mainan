jQuery(document).ready(function($){
   
    $('a.lightbox').click(function(e){
        var imgSrc = $('img', this).attr('src');
        var imgWidth = $(this).attr('width');
        var imgHeight = $(this).attr('height');
        showLightbox(imgSrc, imgWidth, imgHeight);
        
        e.preventDefault();
    });
    
    $('a.woocommerce-main-image, .thumbnails a.zoom').click(function(e){
        var imgSrc = $(this).attr('href');
        var imgWidth = $(this).attr('width');
        var imgHeight = $(this).attr('height');
        
        showLightbox(imgSrc, imgWidth, imgHeight);
        
        e.preventDefault();
    }); 
    
    $('a#lightbox-close').click(function(e){
        $('#mask').hide();
        e.preventDefault();
    });
    
    function showLightbox(imgSrc, width, height) {
   
        var lightboxWidth, lightboxHeight;
        
        $('img.lightbox-image').attr('src', imgSrc);
        
        //alert('win width : ' + $(window).width() + '\n win Height : ' + $(window).height());
        
        $('#mask').show();  //Jika #mask tdk ditampilkan maka lightboxWidth dan lightboxHeight = 0
         console.debug('Height : ' + height + ', Width : ' + width);
        
            lightboxWidth = width;
            lightboxHeight = height;
        
        
        var delta = lightboxHeight - lightboxWidth;
        console.debug('delta : ' + delta);
        
        if( delta > 0 ) {
            //--Portrait
            if( lightboxHeight > $(window).height() ) {
                var lightboxHeight_new = $(window).height() * 0.75;
                lightboxWidth = (lightboxWidth * lightboxHeight_new) / lightboxHeight;
                lightboxHeight = lightboxHeight_new;
            }
            
            //console.debug('Portrait Height : ' + lightboxHeight + ', Width : ' + lightboxWidth);
            /*Jika ternyata setelah lebar dari gambar ybs masih lebih
            * lebar dari lebar window */
            if( lightboxWidth > $(window).width() ) {
                lightboxWidth_new = $(window).width() * 0.75;
                lightboxHeight = (lightboxHeight * lightboxWidth_new) / lightboxWidth;
                lightboxWidth = lightboxWidth_new;
                //$('.lightbox-image').css({ 'width' : lightboxWidth, 'height' : lightboxHeight });
            }
            $('.lightbox-image').css({ 'height' : lightboxHeight, 'width' : lightboxWidth });
            
        } else if( delta < 0 ) {
            //--Landscape
            if( lightboxWidth > $(window).width() ) {
                var lightboxWidth_new = $(window).width() * 0.75;
                lightboxHeight = (lightboxHeight * lightboxWidth_new) / lightboxWidth;
                lightboxWidth = lightboxWidth_new;
            }
            
            /*Jika ternyata setelah tinggi dari gambar ybs masih lebih
            * tinggi dari tinggi window */
            if( lightboxHeight > $(window).height() ) {
                lightboxHeight_new = $(window).height() * 0.75;
                lightboxWidth = (lightboxWidth * lightboxHeight_new) / lightboxHeight;
                lightboxHeight = lightboxHeight_new;
            }
            $('.lightbox-image').css({ 'width' : lightboxWidth, 'height' : lightboxHeight });
            //console.debug('Landscape Height : ' + lightboxHeight + ', Width : ' + lightboxWidth);
        } else {
            //--square
            if( lightboxHeight > $(window).height() ) {
                lightboxHeight = $(window).height() * 0.75;
                lightboxWidth = lightboxHeight;
            }
            $('.lightbox-image').css({ 'height' : lightboxHeight, 'width' : lightboxWidth });
        }
                     
        var topPos = ($(window).height() - lightboxHeight) / 2;
        var leftPos = ($(window).width() - lightboxWidth) / 2;
        
        $('.lightbox-container').css({ 'top' : topPos, 'left' : leftPos });
        $('a#lightbox-close').css({ 'top' : '-15px', 'right' : '-15px' });
        $('.lightbox-container').show();
    }
    
});


