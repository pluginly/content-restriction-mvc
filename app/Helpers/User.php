<?php

namespace ContentRestriction\App\Helpers;

class User {
	private static function includes() {
		if ( ! \function_exists( 'ContentRestriction\\get_userdata' ) ) {
			require_once ABSPATH . WPINC . '/pluggable.php';
		}
	}

	public static function data( int $user_id ) {
		self::includes();

		return get_userdata( $user_id );
	}

	public static function display_name( int $user_id ): string {
		$user_data = self::data( $user_id );
		if ( $user_data ) {
			if ( ! empty( $user_data->display_name ) ) {
				return $user_data->display_name;
			} elseif ( ! empty( $user_data->first_name ) ) {
				return $user_data->first_name;
			} else {
				return $user_data->user_login;
			}
		}

		return '';
	}

	public static function is_logged_in(): bool {
		self::includes();

		return is_user_logged_in();
	}

	public static function ip(): string {
		$ip = '127.0.0.1'; // Local IP
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = sanitize_text_field( $_SERVER['HTTP_CLIENT_IP'] );
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = sanitize_text_field( $_SERVER['HTTP_X_FORWARDED_FOR'] );
		} else {
			$ip = ! empty( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : $ip;
		}

		return $ip;
	}
}