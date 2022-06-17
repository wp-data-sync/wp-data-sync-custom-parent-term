<?php
/**
 * Plugin Name: WP Data Sync - Custom Parent Term
 * Plugin URI:  https://wpdatasync.com/products/
 * Description: Add a custom parent term to existing parent terms.
 * Version:     1.0.2
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

add_filter( 'wp_data_sync_term_parents', function( $term_parents, $term, $taxonomy ) {

	if ( 'product_cat' !== $taxonomy ) {
		return $term_parents;
	}

	if ( isset( $term_parents['mattresses'] ) ) {
		return $term_parents;
	}

	$_terms = [
		'type',
		'size',
		'comfort',
		'sleep-accessories'
	];

	foreach ( $_terms as $_term ) {

		if ( isset( $term_parents[ $_term ] ) ) {

			Log::write( 'custom-term-parents', $term_parents, 'Before modify parent terms' );

			$_term_parents = array_merge( [
				'mattresses' => [
					'name'        => 'Mattresses',
					'description' => '',
					'thumb_url'   => '',
					'term_meta'   => []
				]
			], $term_parents );

			Log::write( 'custom-term-parents', $_term_parents, 'After modify parent terms' );

			return $_term_parents;

		}

	}

	return $term_parents;

}, 20, 3 );
