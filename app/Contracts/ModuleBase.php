<?php

namespace ContentRestriction\App\Contracts;

interface ModuleBase {

	public function boot( $role ): void;

	/**
	 * Unique key of the module, like: override-contents
	 */
	public static function get_key(): string;

	/**
	 * Name of the module, like: Override Contents
	 */
	public static function get_name(): string;

	/**
	 * Sub modules
	 */
	public static function get_sub_modules(): array;

	/**
	 * Get selected options for the module
	 */
	public static function get_options(): array;
}
