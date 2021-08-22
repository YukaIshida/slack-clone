<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;
use App\Models\User;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = json_decode(file_get_contents('database/json/channels.json'), true);

        foreach ($channels as $channel) {
            Channel::factory()->create($channel);
        }

        $users = User::all();
        foreach ($users as $user) {
            Channel::create(['dm_channel_name' => '個人DM', 'dm_user_1' => $user->id, 'dm_user_2' => $user->id]);
        }
    }
}
