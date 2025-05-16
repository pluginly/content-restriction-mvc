<?php

namespace ContentRestriction\App\Providers;

use ContentRestriction\App\Contracts\ModuleBase;

abstract class ModuleServiceProviderBase implements ModuleBase {

	abstract public function boot( $role ): void;
	

	public static function get_icon() {
		return '#';
	}

	/**
	 * Unique key of the module, like: override-contents
	 */
	abstract public static function get_key(): string;

	/**
	 * Name of the module, like: Override Contents
	 */
	abstract public static function get_name(): string;

	/**
	 * Sub modules
	 */
	abstract public static function get_sub_modules(): array;

	/**
	 * Get selected options for the module
	 */
	abstract public static function get_options(): array;
}
