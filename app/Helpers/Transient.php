<?php

namespace ContentRestriction\App\Helpers;

class Transient {
	public static function set( string $key, $value, $expiration = DAY_IN_SECONDS ): bool {
		return set_transient( Key::get( $key ), $value, $expiration );
	}

	public static function get( string $key ) {
		return get_transient( Key::get( $key ) );
	}
}