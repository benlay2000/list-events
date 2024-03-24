<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domains')->insert([
            'user_id' => 1,
            'domain' => 'test1.test',
            'settings' => '{"siteName":"Test 1", "description":"This is a test."}}',
        ]);

        DB::table('domains')->insert([
            'user_id' => 1,
            'domain' => 'test2.test',
            'settings' => '{"siteName":"Test 2", "description":"This is a test."}',
        ]);
    }
}
