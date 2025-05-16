<?php

namespace ContentRestriction\App\Http\Controllers;

use ContentRestriction\App\Repositories\RuleRepository;
use ContentRestriction\WpMVC\Routing\Response;
use WP_REST_Request;

class RuleController extends Controller {
	public function create( WP_REST_Request $request ) {
		$data = (array) $request->get_param( 'data' );

		$errors = [];
		if ( empty( $data ) ) {
			$errors['empty_data'] = __( 'Empty data is provided.', 'content-restriction' );
		}

		if ( ! isset( $data['rule'] ) ) {
			$errors['rule_data_missing'] = __( 'Rule data is missing.', 'content-restriction' );
		}

		if ( ! isset( $data['title'] ) ) {
			$errors['title_missing'] = __( 'Rule title is missing.', 'content-restriction' );
		}

		if ( ! empty( $errors ) ) {
			return Response::send(
				[
					'messages' => $errors,
				], 422
			);
		}

		return Response::send(
			['success' => ( new RuleRepository() )->create( $data )],
		);
	}

	public function read( WP_REST_Request $request ) {
		$id = (string) $request->get_param( 'id' );

		if ( empty( $id ) ) {
			return Response::send(
				[
					'messages' => __( 'Invalid Rule ID is provided.', 'content-restriction' ),
				], 404
			);
		}

		return Response::send(
			['data' => ( new RuleRepository() )->get( $id )],
		);
	}

	public function update( WP_REST_Request $request ) {
		$id   = (string) $request->get_param( 'id' );
		$data = (array) $request->get_param( 'data' );

		$errors = [];

		if ( empty( $id ) ) {
			$errors['id'] = __( 'Invalid Rule ID is provided.', 'content-restriction' );
		}

		if ( empty( $data ) ) {
			$errors['data'] = __( 'Invalid data is provided.', 'content-restriction' );
		}

		if ( ! isset( $data['rule'] ) ) {
			$errors['rule_data_missing'] = __( 'Rule data is missing.', 'content-restriction' );
		}

		if ( ! isset( $data['title'] ) ) {
			$errors['title_missing'] = __( 'Rule title is missing.', 'content-restriction' );
		}

		if ( ! empty( $errors ) ) {
			return Response::send(
				[
					'messages' => $errors,
				], 422
			);
		}

		return Response::send(
			['data' => ( new RuleRepository() )->update( $id, $data )],
		);
	}

	public function delete( WP_REST_Request $request ) {
		$id = (string) $request->get_param( 'id' );

		if ( empty( $id ) ) {
			return Response::send(
				[
					'messages' => __( 'Invalid Rule ID is provided.', 'content-restriction' ),
				], 422
			);
		}

		return Response::send(
			['data' => ( new RuleRepository() )->delete( $id )],
		);
	}

	public function list() {
		try {
			return Response::send(
				['data' => ( new RuleRepository() )->get_all()],
			);
		} catch ( \Throwable $th ) {
			return Response::send(
				[
					'messages' => $th->getMessage(),
				], 422
			);
		}
	}
}