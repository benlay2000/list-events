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
        DB::table('users')->insert([
            'name' => '合同会社deuxh',
            'account_name' => 'elvyta',
            'email' => 's.matsui@engrowth.com',
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
        ]);
    }
}
