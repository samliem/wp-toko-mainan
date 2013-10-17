/* 
 * This script is used in all pages
 */

jQuery(document).ready(function($){
    
    var offsetContent = $('.wrapper').offset();
    var topContent = offsetContent.top;
    
    var offsetNav = $('.main-navigation').offset();
    var topNav = offsetNav.top;
    
    $(window).scroll(function(){
        if( $(this).scrollTop() < topContent ) {
            $('#back-to-top').fadeOut('slow');
        }
        else
            $('#back-to-top').fadeIn('slow');
        
        if( $(this).scrollTop() > topNav ) {
            var wpAdminBar = $('#wpadminbar').height();
            var fixedNavTop = wpAdminBar != null ? wpAdminBar : 0;
            console.debug(wpAdminBar);
            $('.main-navigation').css({'position' : 'fixed', 'top' : fixedNavTop, 'left' : 0, 'margin-top' : 0 });
            $('.main-navigation .site-title').css('display', 'inline-block');
        }
        else {
            $('.main-navigation').css({'position' : 'initial'});
            $('.main-navigation .site-title').css('display', 'none');
        }
    });

    $('#back-to-top').click(function(e){
        e.preventDefault();
        $('html,body').animate({scrollTop:0}, 700);
    });
    
});


