<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Free User',
            'email' => 'user_free@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Pro User',
            'email' => 'user_pro@mail.com',
            'is_pro' => true,
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
    }
}
