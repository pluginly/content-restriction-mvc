<?php

use ContentRestriction\WpMVC\App;
use ContentRestriction\WpMVC\Enqueue\Enqueue;

defined( 'ABSPATH' ) || exit;

Enqueue::script( 'content-restriction-admin-menu-script', 'build/admin/dashboard' );
Enqueue::style( 'content-restriction-admin-menu-style', 'build/admin/dashboard' );

$config  = App::$config->get( 'base-config' );
$icon    = apply_filters( 'menu_icon', 'dashicons-admin-generic' );
$pro_url = $config['pro_upgrade_url'];
$slug    = $config['menu_slug'];

$localize = [
	'admin_base_url'   => admin_url(),
	'ajax_url'         => admin_url( 'admin-ajax.php' ),

	'current_user'     => ! empty( wp_get_current_user()->user_firstname ) ? ucfirst( wp_get_current_user()->user_firstname ) : ucfirst( wp_get_current_user()->display_name ),

	'update_nonce'     => wp_create_nonce( 'content_restriction_update_admin_setting' ),

	'plugin_name'      => __( 'Content Restriction', 'content-restriction' ),
	'plugin_admin_url' => admin_url( 'admin.php?page=' . $slug ),
	'plugin_rest_base' => rest_url( '/content-restriction' ),
	'plugin_version'   => App::$config->get( 'app' )['version'],

	'pro_available'    => defined( 'CONTENT_RESTRICTION_PRO_VERSION' ) ? true : false,

	'rest_args'        => [
		'root'  => esc_url_raw( rest_url() ),
		'nonce' => wp_create_nonce( 'wp_rest' ),
	],
];

wp_localize_script( 'content-restriction-admin-menu-script', 'content_restriction_admin', $localize );