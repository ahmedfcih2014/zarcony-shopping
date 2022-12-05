<?php

namespace Database\Seeders;

use App\Enum\UserEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = "admin@zarcony.shopping";
        User::where('email', $email)->delete();
        User::factory(1)->create(['user_role' => UserEnum::admin_role, 'email' => $email]);
    }
}
