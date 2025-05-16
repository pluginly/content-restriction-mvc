<?php

namespace ContentRestriction\App\Helpers;

class Key {
	public static function get( string $key ): string {
		return \sprintf( '%s%s', self::prefix(), \trim( $key ) );
	}

	public static function prefix(): string {
		return \sprintf(
			'%s%s%s',
			'-',
			'content_restriction',
			'-'
		);
	}
}