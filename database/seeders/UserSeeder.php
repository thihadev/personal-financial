<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	User::truncate();

        $user = User::create([
            'name'              =>  'Admin',
			'email'             =>  'admin@gmail.com',
            'email_verified_at' =>  now()->toDateTimeString(),
            'password'          =>  bcrypt('password'),
        ]);

        // $user->assignRole('Super Admin');

    }
}
