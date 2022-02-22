<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@jaktech.com',
               'phone'=>'0900048949',
               'role'=>'admin',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@jaktech.com',
               'phone'=>'0900000000',
                'role'=>'user',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}