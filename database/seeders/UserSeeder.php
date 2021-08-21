<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = json_decode(file_get_contents('database/json/users.json'), true);
        foreach ($users as $user) {
            User::factory()->create($user);
        }
        
        User::factory(7)->create();
    }
}
