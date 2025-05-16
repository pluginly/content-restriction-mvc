<?php

namespace ContentRestriction\App\Helpers;

class Sanitize {
	public static function arrays( array $array ): array {
		foreach ( $array as &$value ) {
			if ( ! is_array( $value ) ) {
				$value = sanitize_text_field( $value );
			} else {
				self::arrays( $value );
			}
		}

		return $array;
	}
}