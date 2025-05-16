<?php

namespace ContentRestriction\App\Repositories;

use ContentRestriction\App\DTO\RuleCreateDTO;
use ContentRestriction\App\DTO\RuleUpdateDTO;
use ContentRestriction\App\Models\RuleModel;

class RuleRepository {
	private string $option;
	private array $rules;

	public function __construct() {
		$this->option = 'rules';
		$this->rules  = $this->get_all();
	}

	public function create( array $data ): string {
		$dto = ( new RuleCreateDTO )
			->set_title( sanitize_text_field( $data['title'] ) )
			->set_status( true )
			->set_who_can_see( maybe_serialize( $data['rule']['who-can-see'] ) )
			->set_what_content( maybe_serialize( $data['rule']['what-content'] ) )
			->set_restrict_view( maybe_serialize( $data['rule']['restrict-view'] ) )
			->set_priority( 1 );

		try {
			return ( new RuleModel() )->create( $dto );
		} catch ( \Throwable $th ) {
			return 0;
		}
	}

	public function update( string $id, array $data ): string {
		$dto = ( new RuleUpdateDTO )
			->set_id( $id )
			->set_title( sanitize_text_field( $data['title'] ) )
			->set_status( (bool) $data['status'] )
			->set_who_can_see( maybe_serialize( $data['rule']['who-can-see'] ) )
			->set_what_content( maybe_serialize( $data['rule']['what-content'] ) )
			->set_restrict_view( maybe_serialize( $data['rule']['restrict-view'] ) )
			->set_priority( 1 );

		try {
			( new RuleModel() )->update( $dto );

			return true;
		} catch ( \Throwable $th ) {
			error_log( print_r( $th, true ) );

			return false;
		}
	}

	public function delete( string $id ): bool {
		try {
			( new RuleModel() )->delete( $id );

			return true;
		} catch ( \Throwable $th ) {
			return false;
		}
	}

	public function get( string $id ): array {
		// Fetch the rule by id using RuleModel
		$rule = ( new RuleModel )->get( $id );

		// Return an empty array if no rule is found
		if ( ! $rule ) {
			return [];
		}

		// Format the retrieved rule to match the structure used in get_all()
		$rule['status']     = (bool) $rule['status'];
		$rule['modified']   = strtotime( $rule['modified'] );
		$rule['created_at'] = strtotime( $rule['created_at'] );

		$rule['rule']['who-can-see']   = maybe_unserialize( $rule['who_can_see'] );
		$rule['rule']['what-content']  = maybe_unserialize( $rule['what_content'] );
		$rule['rule']['restrict-view'] = maybe_unserialize( $rule['restrict_view'] );

		unset( $rule['who_can_see'] );
		unset( $rule['what_content'] );
		unset( $rule['restrict_view'] );

		return $rule;
	}

	public function get_all(): array {
		$rules = ( new RuleModel )->get_all();

		$rules = array_map(
			function ( $rule ) {
				$rule['status']     = (bool) $rule['status'];
				$rule['modified']   = strtotime( $rule['modified'] );
				$rule['created_at'] = strtotime( $rule['created_at'] );

				$rule['rule']['who-can-see']   = maybe_unserialize( $rule['who_can_see'] );
				$rule['rule']['what-content']  = maybe_unserialize( $rule['what_content'] );
				$rule['rule']['restrict-view'] = maybe_unserialize( $rule['restrict_view'] );

				unset( $rule['who_can_see'] );
				unset( $rule['what_content'] );
				unset( $rule['restrict_view'] );

				return $rule;
			},
			$rules
		);

		return ! empty( $rules ) ? $rules : [];
	}
}