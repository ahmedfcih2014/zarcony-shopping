<?php

namespace Database\Seeders;

use App\Enum\UserEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = "client@zarcony.shopping";
        User::where('email', $email)->delete();
        User::factory(1)->create(['user_role' => UserEnum::client_role, 'email' => $email]);
    }
}
