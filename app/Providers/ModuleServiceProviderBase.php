<?php

namespace ContentRestriction\App\Providers;

abstract class ModuleServiceProviderBase {

	public static array $rule;
	public static array $options;
	public static string $key;
	public static string $name;

	abstract public function boot( $rule ): void;

	/**
	 * Unique key of the module, like: override-contents
	 */
	abstract public static function set_key(): string;

	/**
	 * Name of the module, like: Override Contents
	 */
	abstract public static function set_name(): string;

	abstract public static function set_rule( $rule ): void;

	public static function get_rule(): array {
		return self::$rule ?? [];
	}

	/**
	 * Sub modules
	 */
	abstract public static function get_sub_modules(): array;

	/**
	 * Get selected options for the module
	 */
	abstract public static function get_options(): array;

	public static function get_icon() {
		return '#';
	}
}
