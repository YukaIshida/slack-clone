<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChannelUser;

class ChannelUserController extends Controller
{
    public function store(Request $request)
    {
        // ToDo バリデーション追加
        $channel_user = new ChannelUser();
        $channel_user->channel_id = $request->channel_id;
        $channel_user->user_id = $request->user_id;
        $channel_user->save();

        return new $channel_user;
    }
}
