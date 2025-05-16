<?php

use ContentRestriction\App\Http\Controllers\RuleController;
use ContentRestriction\WpMVC\Routing\Route;

Route::post( 'rules/list', [RuleController::class, 'list'], ['admin'] );
Route::post( 'rules/create', [RuleController::class, 'create'], ['admin'] );
Route::post( 'rules/read', [RuleController::class, 'read'], ['admin'] );
Route::post( 'rules/update', [RuleController::class, 'update'], ['admin'] );
Route::post( 'rules/delete', [RuleController::class, 'delete'], ['admin'] );