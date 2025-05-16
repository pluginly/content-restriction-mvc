<?php

use ContentRestriction\App\Http\Controllers\RuleController;
use ContentRestriction\WpMVC\Routing\Route;

Route::post( 'rules/create', [RuleController::class, 'create'] );
Route::post( 'rules/read', [RuleController::class, 'read'] );
Route::post( 'rules/update', [RuleController::class, 'update'] );
Route::post( 'rules/delete', [RuleController::class, 'delete'] );
Route::post( 'rules/list', [RuleController::class, 'list'] );