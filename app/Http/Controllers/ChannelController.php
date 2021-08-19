<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Http\Resources\ChannelResource;

class ChannelController extends Controller
{
    public function store(Request $request)
    {
        // ToDo バリデーション追加
        $channel = new Channel();
        $channel->channel_name = $request->channel_name;
        $channel->save();

        return new ChannelResource($channel);
    }

}
