<?php

use ContentRestriction\App\Http\Controllers\UserController;
use ContentRestriction\WpMVC\Routing\Ajax;

Ajax::get( 'user/{id}', [UserController::class, 'index'], ['admin'] );
