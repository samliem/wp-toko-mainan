jQuery(document).ready(function($) {
          
    $('a', 'ul#tabs li').click(function(e) {
        var parent = $(this).parent();
        if( !$(parent).hasClass('tab-active') ) {
            $('li', 'ul#tabs').removeClass('tab-active');
            $(parent).addClass('tab-active');
            $('form').hide();
            var activatedForm = $(this).attr('href');
            $(activatedForm).show();
            var hrefAttr = $(this).attr('href').split('-');
            $.cookie( 'jrl_theme_tab', hrefAttr[1], { path: '/wordpress/wp-admin/' } );
        }             
        e.preventDefault();
    });
          
});

