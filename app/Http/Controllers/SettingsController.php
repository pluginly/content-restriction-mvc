<?php

namespace ContentRestriction\App\Http\Controllers;

use ContentRestriction\App\Repositories\IntegrationsRepository;
use ContentRestriction\App\Repositories\SettingsRepository;

class SettingsController extends Controller {
	public function fields() {
		return SettingsRepository::get_fields();
	}

	public function get_all() {
		return SettingsRepository::all();
	}

	public function update( \WP_REST_Request $request ) {
		$settings = $request->get_params();

		return SettingsRepository::update_batch( $settings );
	}

	public function integrations(): array {
		return IntegrationsRepository::get_all();
	}
}