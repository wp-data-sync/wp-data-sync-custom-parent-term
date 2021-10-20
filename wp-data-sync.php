<?php
/**
 * Plugin Name: WP Data Sync - Custom Parent Term
 * Plugin URI:  https://wpdatasync.com/products/
 * Description: Add a custom parent term to existing parent terms.
 * Version:     1.0.1
 * Author:      WP Data Sync
 * Author URI:  https://wpdatasync.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-data-sync
 *
 * Package:     WP_DataSync
*/

namespace WP_DataSync\App;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add custom term parent.
 *
 * @param array  $term_parents
 * @param array  $term
 * @param string $taxonomy
 *
 * @return array
 */

add_action( 'wp_data_sync_term_parents', function( $term_parents, $term, $taxonomy ) {

	if ( isset( $term_parents['type'] ) && 'product_cat' === $taxonomy ) {

		Log::write( 'custom-term-parents', $term_parents, 'Before add parent term' );

		$additional_parent_term                = [];
		$additional_parent_term['mattresses'] = [
			'name'        => 'Mattresses',
			'description' => '',
			'thumb_url'   => '',
			'term_meta'   => []
		];


		$term_parents = $additional_parent_term + $term_parents;

		Log::write( 'custom-term-parents', $term_parents, 'After add parent term' );

	}

	return $term_parents;

}, 20, 3 );
