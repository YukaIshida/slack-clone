<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DmChannelController;
use App\Http\Controllers\ChannelUserController;
use App\Http\Controllers\CacheController;

Route::middleware('auth:api')->group(function(){
    Route::get('auth-user', [AuthUserController::class, 'show']);
    Route::post('dm-channel', [DmChannelController::class, '__invoke']);
    Route::get('dm-channels', [DmChannelController::class, 'index']);
    Route::delete('channel-users', [ChannelUserController::class, 'destroy']);
    Route::get('get-channel', [CacheController::class, 'getChannel']);
    Route::post('cache', [CacheController::class, 'set']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResources([
        '/messages' => MessageController::class,
        '/channels' => ChannelController::class,
        '/users' => UserController::class,
        '/channel-users' => ChannelUserController::class,
    ]);
});
