<?php

defined( 'ABSPATH' ) || exit;

use ContentRestriction\WpMVC\App;

/**
 * Plugin Name:       All-in-One Content Restriction
 * Description:       Content Restriction - A simple and user-friendly plugin to restrict users / visitors from viewing posts by restricting access, as simple as that.
 * Version:           1.4
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Tested up to:      6.8
 * Author:            ContentRestriction.com
 * Author URI:        https://contentrestriction.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       content-restriction
 * Domain Path:       /languages
 */

require_once __DIR__ . '/vendor/vendor-src/autoload.php';
require_once __DIR__ . '/app/Helpers/helper.php';

final class ContentRestriction {
	public static ContentRestriction $instance;

	public static function instance(): ContentRestriction {
		if ( empty( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function load() {
		$application = App::instance();

		$application->boot( __FILE__, __DIR__ );

		/**
		 * Fires once activated plugins have loaded.
		 *
		 */
		add_action(
			'plugins_loaded', function () use ( $application ): void {

				do_action( 'content_restriction_before_load' );

				$application->load();

				do_action( 'content_restriction_after_load' );
			}
		);
	}
}

ContentRestriction::instance()->load();
