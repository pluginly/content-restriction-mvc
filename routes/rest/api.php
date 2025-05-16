<?php

use ContentRestriction\App\Http\Controllers\UserController;
use ContentRestriction\WpMVC\Routing\Route;

Route::get( 'user', [UserController::class, 'index'], ['admin'] );