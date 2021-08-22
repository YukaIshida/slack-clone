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
            $channel->dm_user_1 = $request->input('dm_user_1');
            $channel->dm_user_2 = $request->input('dm_user_2');
            $channel->save();
            $channel_id = $channel->id;
        }

        return $channel_id;
    }

    public function index(Request $request)
    {
        // ToDo バリデーションとポリシー（？）追加
        $two_weeks_ago = date("Y-m-d H:i:s",strtotime("-2 week"));;
        $channels = Channel::query()
                ->whereHas('messages', function ($query) use ($two_weeks_ago) {
                    $query->where('updated_at', '>=', $two_weeks_ago);
                })
                ->get();

        return $channels;
    }    
}
