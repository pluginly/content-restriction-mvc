<?php

namespace ContentRestriction\App\Providers;

class BlurServiceProvider implements ModuleServiceProviderBase {

	public function boot( $rule ): void;

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
	

	public static function get_sub_modules(): array {
		$modules[] = [
			'name'       => __( 'Blur', 'content-restriction' ),
			'key'        => 'blur',
			'icon'       => self::get_icon(),
			'desc'       => __( 'Blur title, excerpt and description.', 'content-restriction' ),
			'type'       => 'section',
			'group'      => 'wordpress',
			'options'    => [
				'apply_to' => [
					'title'   => __( 'Apply To', 'content-restriction' ),
					'type'    => 'multi-select',
					'options' => [
						'title'   => __( 'Title', 'content-restriction' ),
						'content' => __( 'Content', 'content-restriction' ),
						'excerpt' => __( 'Excerpt', 'content-restriction' ),
					],
				],
				'level'    => [
					'title'   => __( 'Level', 'content-restriction' ),
					'type'    => 'range',
					'default' => 20,
				],
				'spread'   => [
					'title'   => __( 'Spread', 'content-restriction' ),
					'type'    => 'range',
					'default' => 40,
				],
			],
			'conditions' => apply_filters(
				'content_restriction_module_blur_conditions',
				[
					'what_content' => [
						'all_posts',
						'posts_with_categories',
						'specific_posts',
						'posts_with_tags',
						'all_pages',
						'specific_pages',
						'frontpage',
						'shortcode',
					],
					'compare'      => 'has_any',
				],
			),
		];

		return $modules;
	}

	public static function get_icon() {
		return '#';
	}


}