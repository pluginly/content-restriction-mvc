<?php

namespace ContentRestriction\App\Http\Controllers;

use ContentRestriction\WpMVC\Routing\Response;

class ModuleController extends Controller {
	public function who_can_see( \WP_REST_Request $request ): array {
		$modules = apply_filters( 'content_restriction_who_can_see_module_list', [] );

		try {
			return Response::send(
				['data' => $this->filter( $request, $modules )],
			);
		} catch ( \Throwable $th ) {
			return Response::send(
				[
					'messages' => $th->getMessage(),
				], 422
			);
		}
	}

	public function what_content( \WP_REST_Request $request ): array {
		$modules = apply_filters( 'content_restriction_what_content_module_list', [] );

		try {
			return Response::send(
				['data' => $this->filter( $request, $modules )],
			);
		} catch ( \Throwable $th ) {
			return Response::send(
				[
					'messages' => $th->getMessage(),
				], 422
			);
		}
	}

	public function restrict_view( \WP_REST_Request $request ): array {
		$modules = apply_filters( 'content_restriction_restrict_view_module_list', [], $request );

		try {
			return Response::send(
				['data' => $this->filter( $request, $modules )],
			);
		} catch ( \Throwable $th ) {
			return Response::send(
				[
					'messages' => $th->getMessage(),
				], 422
			);
		}
	}

	/**
	 * Register Groups for Modules
	 */
	public function groups(): array {
		return apply_filters( 'content_restriction_module_group_list', [] );
	}

	/**
	 * Before Sending Response Filter All The Modules
	 * To Ensure That The Admin Frontend Showing Correct Result
	 */
	private function filter( \WP_REST_Request $request, array $modules ): array {
		$filter_keys = ['what_content', 'who_can_see', 'restrict_view'];

		foreach ( $modules as $key => $module ) {

			/**
			 * Add selected key to the module
			 */
			foreach ( $filter_keys as $filter_key ) {
				$param_value = $request->get_param( $filter_key );
				if ( $module['key'] === $param_value ) {
					$modules[$key]['selected'] = true;
				}
			}

			/**
			 * This filter is used to modify the module before the condition check.
			 */
			$modules[$key] = apply_filters( 'content_restriction_module_condition_check_before', $module, $request );

			/**
			 * If the module has no conditions, don't run remaining code.
			 */
			if ( ! isset( $modules[$key]['conditions'] ) ) {
				continue;
			}

			/**
			 * Check if the current module meets the conditions.
			 */
			foreach ( $filter_keys as $filter_key ) {
				$param_value      = $request->get_param( $filter_key );
				$condition_values = $module['conditions'][$filter_key] ?? [];
				$compare          = $module['conditions']['compare'] ?? 'has_any';

				if ( empty( $param_value ) || empty( $condition_values ) ) {
					continue;
				}

				// If compare is 'not_in' and the value is in the condition_values, unset the module
				if ( 'not_in' === $compare && in_array( $param_value, $condition_values ) ) {
					unset( $modules[$key] );
					continue 2; // Skip to the next module
				}

				// If compare is 'has_any' (default) and the value is not in the condition_values, unset the module
				if ( 'has_any' === $compare && ! in_array( $param_value, $condition_values ) ) {
					unset( $modules[$key] );
					continue 2; // Skip to the next module
				}
			}
		}

		return array_values( $modules );
	}
}