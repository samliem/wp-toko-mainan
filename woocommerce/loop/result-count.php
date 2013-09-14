<?php
/**
 * replace woocommerce result-count.php
 * menambahkan apply_filters untuk $result_count_message
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<p class="woocommerce-result-count">
    <?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
        
        

	if ( 1 == $total ) {
            $result_count_message = apply_filters(
                'result_count_message', 
                'Showing the single result', $total);
		_e( 'Showing the single result', 'woocommerce' );
	} elseif ( $total <= $per_page ) {
            $default_message = "Showing all $total results";
            $result_count_message = apply_filters(
                'result_count_message', 
                $default_message, $total);
            printf( __( $result_count_message, 'woocommerce' ) );
	} else {
            printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
	}
    ?>
</p>