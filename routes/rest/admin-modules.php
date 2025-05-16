<?php

use ContentRestriction\App\Http\Controllers\ModuleController;
use ContentRestriction\WpMVC\Routing\Route;

Route::post( 'modules/who-can-see', [ModuleController::class, 'who_can_see'], ['admin'] );
Route::post( 'modules/what-content', [ModuleController::class, 'what_content'], ['admin'] );
Route::post( 'modules/restrict-view', [ModuleController::class, 'restrict_view'], ['admin'] );
Route::post( 'modules/groups', [ModuleController::class, 'groups'], ['admin'] );