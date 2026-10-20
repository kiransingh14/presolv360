<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        'name' => 'kiran',
        'email'=>'kiran@gmail.com',
        'mobile' => '9987979999',
        'password' => '1234'
        ]);
    }
}
