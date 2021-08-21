<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;

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
    }
}
