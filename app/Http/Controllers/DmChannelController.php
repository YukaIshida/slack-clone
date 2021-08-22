<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

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

    public function index()
    {
        // ToDo バリデーションとポリシー（？）追加
        $two_weeks_ago = date("Y-m-d H:i:s",strtotime("-2 week"));;
        $channels = Channel::query()
            ->where(function ($query) use ($two_weeks_ago) {
                    $query->whereHas('messages', function ($query) use ($two_weeks_ago) {
                        $query->where('updated_at', '>=', $two_weeks_ago);
                    })
                    ->where(function ($query) {
                        $query->where('dm_user_1', Auth::user()->id)
                        ->OrWhere('dm_user_2', Auth::user()->id);
                    });
                })
            ->OrWhere(function ($query) {
                $query->where('dm_user_1', Auth::user()->id)
                ->where('dm_user_2', Auth::user()->id);
            })
            ->get();

        $dmUsers = [];
        foreach($channels as $channel) {
            if ($channel->dm_user_1 == Auth::user()->id) {
                $user = User::where('id', $channel->dm_user_2)->get()->first();
            } else {
                $user = User::where('id', $channel->dm_user_1)->get()->first();
            }

            $dmUsers[] = new UserResource($user);
        }

        return json_encode($dmUsers);
    }    
}
