<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Salawat Joldasbaev',
                'phone' => '+998907091931',
                'password' => Hash::make('1931'),
                'is_premium' => true,
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ikhlas Aralbaev',
                'phone' => '+998953555020',
                'password' => Hash::make('5020'),
                'is_premium' => true,
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Saliq Bisenov',
                'phone' => '+998906503099',
                'password' => Hash::make('3099'),
                'is_premium' => false,
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
