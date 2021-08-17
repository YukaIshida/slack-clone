<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function(){
    Route::get('auth-user', [AuthUserController::class, 'show']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
