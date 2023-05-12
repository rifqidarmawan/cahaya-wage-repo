<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name' => 'admin',
        'username' => 'admin',
        'address' => 'jalan mesjid raya',
        'phone_number' => '08992900929',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'),
        'roles' => 1,

        ]);

        User::create([
        'name' => 'pengguna',
        'username' => 'pengguna',
        'address' => 'jalan mesjid raya',
        'phone_number' => '08992900929',
        'email' => 'pengguna@gmail.com',
        'password' => bcrypt('password'),
        'roles' => 0,
        ]);

        User::create([
        'name' => 'Pengguna Baru',
        'username' => 'penggunabaru',
        'address' => 'jalan mesjid raya',
        'phone_number' => '08992900929',
        'email' => 'penggunabaru@gmail.com',
        'password' => bcrypt('password'),
        'roles' => 0,
        ]);
    }

}
