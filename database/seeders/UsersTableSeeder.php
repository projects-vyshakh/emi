<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data   = [
            ['name' => 'developer', 'username' => 'developer',  'email' => 'developer@example.com', 'password' => Hash::make('Test@Tuna123#'), 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('users')->insert($data);
    }
}
