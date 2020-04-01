<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        User::create([
            'name' => 'Mr. Owner',
            'email' => 'owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        User::create([
            'name' => 'Mr. Seeker',
            'email' => 'seeker@mail.com',
            'password' => bcrypt('password'),
            'role' => 2,
            'email_verified_at' => Carbon\Carbon::now()
        ]);
    }
}
