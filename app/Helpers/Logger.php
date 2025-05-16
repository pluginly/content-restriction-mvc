<?php

namespace ContentRestriction\App\Helpers;

class Logger {
	public static function add( $data, string $prefix = '' ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( $prefix . ' : ' . print_r( $data, true ) );
		}
	}
}