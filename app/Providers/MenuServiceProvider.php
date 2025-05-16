<?php

namespace ContentRestriction\App\Providers;

use ContentRestriction\WpMVC\Contracts\Provider;
use LoginMeNow\WpMVC\App;

class MenuServiceProvider implements Provider {
	public function boot() {
		add_action( 'admin_menu', [$this, 'add_menu'] );
	}

	public function add_menu(): void {
		$content_restriction_icon = apply_filters( 'menu_icon', 'dashicons-admin-generic' );
		$config                   = App::$config->get( 'base-config' );
		$icon                     = apply_filters( 'menu_icon', 'dashicons-admin-generic' );
		$cap                      = $config['menu_cap'];
		$slug                     = $config['menu_slug'];

		if ( ! current_user_can( $cap ) ) {
			return;
		}

		add_menu_page(
			__( 'All-in-One Content Restriction', 'content-restriction' ),
			apply_filters(
				'content_restriction_title',
				__( 'AIO Content Restriction', 'content-restriction' )
			),
			$cap,
			$slug,
			[$this, 'render_dashboard'],
			$content_restriction_icon,
		);

		add_submenu_page(
			$slug,
			__( 'Dashboard', 'content-restriction' ),
			__( 'Dashboard', 'content-restriction' ),
			$cap,
			$slug,
			[$this, 'render_dashboard'],
		);

		add_submenu_page(
			$slug,
			__( 'All Rules', 'content-restriction' ),
			__( 'All Rules', 'content-restriction' ),
			$cap,
			$slug . '#/rules',
			[$this, 'render_dashboard'],
		);

		add_submenu_page(
			$slug,
			__( 'Create Rule', 'content-restriction' ),
			__( 'Create Rule', 'content-restriction' ),
			$cap,
			$slug . '#/rule',
			[$this, 'render_dashboard'],
		);

		add_submenu_page(
			$slug,
			__( 'Integrations', 'content-restriction' ),
			__( 'Integrations', 'content-restriction' ),
			$cap,
			$slug . '#/integrations',
			[$this, 'render_dashboard'],
		);

		if ( ! defined( 'CONTENT_RESTRICTION_PRO_VERSION' ) ) {
			// add_submenu_page(
			// 	$slug,
			// 	__( 'Upgrade', 'content-restriction' ),
			// 	__( 'Upgrade', 'content-restriction' ),
			// 	$cap,
			// 	$slug . '-upgrade-to-pro',
			// 	[$this, 'render_admin_dashboard']
			// );

			// // Rewrite the menu item.
			// global $submenu;
			// $submenu[$slug][4][2] = 'https://contentrestriction.com/pricing/';
		}
	}

	public function render_dashboard(): void {
		include_once 'Views/dashboard.php';
	}
}