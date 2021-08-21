<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\ChannelCollection;

class ChannelController extends Controller
{
    public function index(Request $request)
    {
        // ToDo ポリシー追加?(Passportと併用出来るかテストする)
        if ($request->has('searchKey') && !empty($request->input('searchKey'))) {
            $channels = Channel::where('channel_name', 'like', "%" . $request->input('searchKey') . "%")->get();
        } else {
            $channels = Channel::all();
        }

        return new ChannelCollection($channels);
    }

    public function store(Request $request)
    {
        // ToDo バリデーション追加
        $channel = new Channel();
        $channel->channel_name = $request->channel_name;
        $channel->save();

        return new ChannelResource($channel);
    }

}
