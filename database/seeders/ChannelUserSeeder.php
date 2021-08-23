<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChannelUser;
use App\Models\User;

class ChannelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            // チャンネルid12: general, 13: random
            ChannelUser::create(['channel_id' => 12, 'user_id' => $user->id]);
            ChannelUser::create(['channel_id' => 13, 'user_id' => $user->id]);
        }
    }
}
