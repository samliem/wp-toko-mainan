/* 
 * Styling widget in footer
 * Style only applied to the first word
 */

jQuery(document).ready(function($) {
    
    $('.widget-title', '.widget-footer').each(function(){
        var widgetTitle = $(this).html();
        if( widgetTitle.indexOf(" ") > 0 ) {
            var pos = widgetTitle.indexOf(" ");
            var firstTitleWord = widgetTitle.substr(0, pos);
            var newFirstTitleWord = '<span>' + firstTitleWord + '</span>';
            widgetTitle = newFirstTitleWord + widgetTitle.substr(pos);
        } else {
            widgetTitle = '<span>' + widgetTitle + '</span>';
        }
        $(this).html(widgetTitle);
    });
    
});


