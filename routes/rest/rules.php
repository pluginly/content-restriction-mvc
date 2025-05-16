<?php

use ContentRestriction\App\Http\Controllers\RuleController;
use ContentRestriction\WpMVC\Routing\Route;

Route::post( 'rules/fields', [RuleController::class, 'fields'], ['admin'] );
Route::post( 'rules/get-all', [RuleController::class, 'get_all'], ['admin'] );
Route::post( 'rules/update', [RuleController::class, 'update'], ['admin'] );
Route::post( 'rules/integrations', [RuleController::class, 'integrations'], ['admin'] );