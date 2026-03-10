<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;

Route::apiResource('lost-items', LostItemController::class);