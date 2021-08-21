<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;

class DmChannelController extends Controller
{
    public function __invoke(Request $request)
    {
        // ToDo バリデーションとポリシー（？）追加
        if(Channel::where('dm_channel_name', $request->input('dm_channel_name'))->exists()) {
            $channel_id = Channel::where('dm_channel_name', $request->input('dm_channel_name'))->get()->first()->id;
        } else {
            $channel = new Channel();
            $channel->dm_channel_name = $request->input('dm_channel_name');
            $channel->save();
            $channel_id = $channel->id;
        }

        return $channel_id;
    }
}
