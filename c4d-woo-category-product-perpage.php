<?php
/*
Plugin Name: C4D Woocommerce Category Product Perpage
Plugin URI: http://coffee4dev.com/
Description: Add a product per page box at Woocommerce category page.
Author: Coffee4dev.com
Author URI: http://coffee4dev.com/
Text Domain: c4d-woo-cpp
Version: 2.0.0
*/

define('C4DWCPP_PLUGIN_URI', plugins_url('', __FILE__));

add_shortcode('c4dwcpp', 'c4dwcpp_shortcode');
add_filter( 'loop_shop_per_page', 'c4dwcpp_product_perpage', 20 );
add_action('woocommerce_before_shop_loop', 'c4dwcpp_auto_add_to_category_page', 50);
add_filter( 'plugin_row_meta', 'c4dwcpp_plugin_row_meta', 10, 2 );

function c4dwcpp_plugin_row_meta( $links, $file ) {
    if ( strpos( $file, basename(__FILE__) ) !== false ) {
        $new_links = array(
            'visit' => '<a href="http://coffee4dev.com">Visit Plugin Site</<a>',
            'forum' => '<a href="http://coffee4dev.com/forums/">Forum</<a>',
            'premium' => '<a href="http://coffee4dev.com">Premium Support</<a>'
        );
        
        $links = array_merge( $links, $new_links );
    }
    
    return $links;
}

function c4dwcpp_product_perpage ( $count ) {
	if (isset($_GET['product_perpage']) && $_GET['product_perpage'] != '') {
		return esc_attr($_GET['product_perpage']);
	}
	return $count;
}

function c4dwcpp_shortcode ($params) {
	return c4dwcpp_select_box();
}

function c4dwcpp_auto_add_to_category_page() {
	echo c4dwcpp_select_box();
}

function c4dwcpp_select_box() {
	ob_start();
	$template = get_template_part('c4d-woo-category-product-perpage/templates/default');
	if ($template && file_exists($template)) {
		require $template;
	} else {
		require dirname(__FILE__). '/templates/default.php';
	}
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}


