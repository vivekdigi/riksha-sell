<?php
/**
 * Taxonomy Template for Riksha Brand (riksha_brand)
 * Automatically forwards term queries to the Riksha Inventory Filter page.
 */

$queried = get_queried_object();
if ( $queried && isset( $queried->name ) ) {
	if ( empty( $_GET['brand'] ) ) {
		$_GET['brand'] = array( $queried->name );
	}
}

require get_template_directory() . '/template-inventory-filter.php';
