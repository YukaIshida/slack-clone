<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function destroy(Request $request)
    {
        info($request);
        try {
            ChannelUser::where('user_id', $request->user_id)
            ->where('channel_id', $request->channel_id)
            ->firstOrFail()
            ->delete();

        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }

        return response()->json([], 204);
    }
}
