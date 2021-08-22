<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Channel extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function getRecentlyTalkedChannels($ago1, $ago2)
    {
        $channels = self::query()
        ->where(function ($query) use ($ago1, $ago2) {
                $query->whereHas('messages', function ($query) use ($ago1) {
                    $query->where('messages.updated_at', '>=', $ago1);
                })
                ->orWhere('channels.created_at', '>=', $ago2);
            })
        ->where(function ($query) {
            $query->where('dm_user_1', Auth::user()->id)
            ->OrWhere('dm_user_2', Auth::user()->id);
        })
        ->get();

        return $channels;
    }
}
