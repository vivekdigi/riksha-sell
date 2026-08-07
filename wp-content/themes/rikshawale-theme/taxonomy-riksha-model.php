<?php
/**
 * Taxonomy Template for Riksha Model (riksha-model)
 * Automatically forwards term queries to the Riksha Inventory Filter page.
 */

$queried = get_queried_object();
if ( $queried && isset( $queried->name ) ) {
	if ( empty( $_GET['model'] ) ) {
		$_GET['model'] = array( $queried->name );
	}
}

require get_template_directory() . '/template-inventory-filter.php';
