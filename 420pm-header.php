<?php
/**
 * Loads the 420pm environment.
 *
 * @package 420pm
 */

if ( ! isset( $pm420_did_header ) ) {

	$pm420_did_header  = true;

	// Load the WordPress library.
	require_once( dirname( __FILE__ ) . '/420pm-load.php' );

}
