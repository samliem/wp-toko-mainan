/* 
 * Script to hide / show sub product category
 * 
 */

jQuery(document).ready(function($) {
    //$('.children', '.jrl-product-categories' ).hide(); 
    
    $('.cat-item').hover(
        function() {
            $subCategory = $(this).find('.children').filter(':first');
            var itemWidth = $subCategory.parent().width();
            $subCategory.css('left', itemWidth);
            $subCategory
                .stop(true, true)
                .show();
        },
        function() {
            $subCategory = $(this).find('.children').filter(':first');
            $subCategory
                .stop(true, true)
                .delay(200)
                .hide(); 
        }
    );
    
});


