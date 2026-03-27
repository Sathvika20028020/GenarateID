<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Labour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Create Admin
      User::create([
          'name'          => 'Admin',
          'email'         => 'admin@gmail.com',
          'password'      => Hash::make('123456'),
          'role'          => 1
      ]);
    }
}
