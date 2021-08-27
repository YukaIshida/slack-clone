<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Channel;
use App\Http\Resources\ChannelResource;

class CacheController extends Controller
{
    public function getChannel()
    {
        $value = Cache::get('channel_id');
        if ($value) {
            $channel_id = $value;
        } else {
            $channel_id = 12;
        }
        
        $channel = Channel::where('id', $channel_id)->get()->first();

        return new ChannelResource($channel);
    }

    public function set(Request $request)
    {
        $key = $request->input('channel_id');
        $value = $request->input('value');
        Cache::forget($key);
        Cache::put($key, $value);
        $val = Cache::get($key);
        return $val;
    }
}
