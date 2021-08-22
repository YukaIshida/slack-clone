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

    public static function getRecentlyTalkedChannels($ago)
    {
        $channels = self::query()
        ->where(function ($query) use ($ago) {
                $query->whereHas('messages', function ($query) use ($ago) {
                    $query->where('updated_at', '>=', $ago);
                })
                ->where(function ($query) {
                    $query->where('dm_user_1', Auth::user()->id)
                    ->OrWhere('dm_user_2', Auth::user()->id);
                });
            })
        ->get();

        return $channels;
    }
}
