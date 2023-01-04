<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//import model user
use App\Models\User;
class UserSeeder extends Seeder
{
    
    public function run()
    {
       User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'username' => 'admin',
        'role' => 'admin',
        'password' => bcrypt('admin123'),
        //supaya terenkripsi
       ]);
    }
}
