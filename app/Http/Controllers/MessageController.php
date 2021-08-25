<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\File;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageCollection;
use App\Events\MessageCreated;

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
        info($request);
        // ToDo バリデーション追加
        $message = new Message();
        $message->channel_id = $request->channel_id;
        $message->user = $request->user;
        $message->content = $request->content;
        $message->save();

        if(!empty($request->file)) {
            $file_name = $request->file->getClientOriginalName();
	        $request->file->storeAs('public/',$file_name);

            $file = new File();
            $file->message_id = $message->id;
            $file->file_path = '/storage/' . $file_name;
            $file->save();
        }

        event(new MessageCreated($message));
        return new MessageResource($message);
    }
}
