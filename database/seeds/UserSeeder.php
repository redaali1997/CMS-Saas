<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'reda@example.com')->first();

        if(!$user){
            User::create([
                'name' => 'reda',
                'email' => 'reda@example.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
