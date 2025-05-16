<?php
/**
 * @package ContentRestriction
 * @since   1.0.0
 * @version 1.0.0
 */

namespace ContentRestriction\Modules\Blur;

class Blur extends \ContentRestriction\Common\RestrictViewBase {

	public function __construct( $who_can_see, $what_content, array $rule ) {
		$this->type         = 'restrict-view';
		$this->module       = 'blur';
		$this->rule         = $rule;
		$this->who_can_see  = $who_can_see;
		$this->what_content = $what_content;
		$this->options      = $rule['rule'][$this->type][$this->module] ?? [];
		$this->protection   = new Protection( $what_content, $this->options, $rule );
	}

	/**
	 * Initializes blur protection on restricted content if access is denied.
	 */
	public function boot(): void {
		$who_can_see = new $this->who_can_see( $this->rule );
		if ( $who_can_see->has_access() ) {
			return;
		}

		// Hook into all three filters
		add_filter( 'content_restriction_the_title', [$this, 'modify_content'], 10 );
		add_filter( 'content_restriction_the_excerpt', [$this, 'modify_content'], 1 );
		add_filter( 'content_restriction_the_content', [$this, 'modify_content'] );
	}

	/**
	 * Applies blur protection to title, excerpt, or content based on settings.
	 */
	public function modify_content( $content, $type = '' ): string {
		switch ( current_filter() ) {
			case 'content_restriction_the_title':
				$type = 'title';
				break;
			case 'content_restriction_the_excerpt':
				$type = 'excerpt';
				break;
			case 'content_restriction_the_content':
				$type = 'content';
				break;
		}

		error_log( '333333 : ' . print_r(333333 ,true) );
		if ( ! $type || ! $this->should_apply( $type ) ) {
			return $content;
		}

		$this->protection->set_post_id( get_the_ID() ?: 0 );

		return $this->protection->add( $content );
	}

	/**
	 * Determines whether blur should be applied to a given content type.
	 */
	private function should_apply( string $type ): bool {
		return in_array( $type, $this->options['apply_to'] ?? [], true );
	}
}