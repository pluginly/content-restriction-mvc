<?php

use ContentRestriction\App\Http\Controllers\SettingsController;
use ContentRestriction\WpMVC\Routing\Route;

Route::post( 'settings/fields', [SettingsController::class, 'fields'], ['admin'] );
Route::post( 'settings/get-all', [SettingsController::class, 'get_all'], ['admin'] );
Route::post( 'settings/update', [SettingsController::class, 'update'], ['admin'] );
Route::post( 'settings/integrations', [SettingsController::class, 'integrations'], ['admin'] );