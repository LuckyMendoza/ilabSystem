<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'       => "1",
            'fname'       => "Admin",
            'email'   => 'admin@gmail.com',
            'password'   => Hash::make('admin'),
            'user_type'   => 'admin',
            'is_verified'   => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            
        ]);

        // Generate 8 fake user records
    

       


    }
}
