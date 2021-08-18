<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageCollection;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // ToDo ポリシー追加?(Passportと併用出来るかテストする)
        $messages = Message::getChannelMessage($request->channel_id);
        return new MessageCollection($messages);
    }

    public function store(Request $request)
    {
        // ToDo バリデーション追加
        $message = new Message();
        $message->channel_id = $request->channel_id;
        $message->user = $request->user;
        $message->content = $request->content;
        $message->save();

        return new MessageResource($message);
    }
}
