<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(40)->create();
        User::create([
                'name' => 'Jennifer Austin',
                'email' => 'email.test@gmail.com',
                'password' => '$2y$10$ZwMu/cTCSdc8o9vfwnty/u55r2l0AynS8Qq1cW/GIvqqH53oT0uVy', // password test (12345678)
            ]
        );
    }
}
