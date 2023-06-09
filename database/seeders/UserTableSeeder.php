<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // http://country.io/phone.json

    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'prianandaazhar2001@gmail.com',
                'username' => 'azhar620',
                'password' => Hash::make("Azhar20062001"),
                'phone' => '087875587801',
                'country_code' => 'id',
                'last_ip' => '111.94.63.54',
                'is_verified' => true,
                'user_profile_img' => '/',
                'address' => "address address address address address address "
            ],
        ]);
    }
}
