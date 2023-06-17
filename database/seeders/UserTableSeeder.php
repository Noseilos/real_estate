<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            // ADMIN
            [
                'name' => 'Noseilos',
                'username' => 'admin noseilos',
                'email' => 'noseilos@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'status' => 'active',
            ],

            // AGENT
            [
                'name' => 'Synetos',
                'username' => 'agent synetos',
                'email' => 'synetos@gmail.com',
                'password' => Hash::make('agent'),
                'role' => 'agent',
                'status' => 'active',
            ],
        ]);
    }
}
