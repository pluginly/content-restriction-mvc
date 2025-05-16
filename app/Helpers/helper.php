<?php

defined( 'ABSPATH' ) || exit;

use ContentRestriction\WpMVC\App;
use ContentRestriction\DI\Container;

function content_restriction():App {
    return App::$instance;
}

function content_restriction_config( string $config_key ) {
    return content_restriction()::$config->get( $config_key );
}

function content_restriction_app_config( string $config_key ) {
    return content_restriction_config( "app.{$config_key}" );
}

function content_restriction_version() {
    return content_restriction_app_config( 'version' );
}

function content_restriction_container():Container {
    return content_restriction()::$container;
}

function content_restriction_singleton( string $class ) {
    return content_restriction_container()->get( $class );
}

function content_restriction_url( string $url = '' ) {
    return content_restriction()->get_url( $url );
}

function content_restriction_dir( string $dir = '' ) {
    return content_restriction()->get_dir( $dir );
}

function content_restriction_render( string $content ) {
    //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $content;
}