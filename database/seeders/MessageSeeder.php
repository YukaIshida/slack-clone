<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\Channel;
use  App\Models\User;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = Channel::whereNotNull('channel_name')->get();
        $user = User::first();
        foreach ($channels as $channel) {
            $channel->messages()->create(['user' => $user->name, 'content' => 'sample_content']);
        }
    }
}
