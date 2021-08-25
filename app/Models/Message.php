<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function channelUsers()
    {
        return $this->hasMany(MessageFile::class);
    }

    public static function getChannelMessage($channel_id)
    {
        return self::where('channel_id', $channel_id)->get();
    }
}
