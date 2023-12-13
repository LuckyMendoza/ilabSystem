<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
            'id'       => "1",
            'fname'       => "System",
            'lname'       => "Admin",
            'email'   => 'admin@gmail.com',
            'password'   => Hash::make('admin'),
            'user_type'   => 'admin',
            'is_verified'   => '1'
        ]);

        $faker = Faker::create();
        $addressCount = 10;
        for ($i = 1; $i <= $addressCount; $i++) {
            User::create([
                'fname' => $faker->firstName,
                'lname' =>  $faker->lastName,
                'gender' => $faker->randomElement(['male', 'female']),
                'email' => $faker->unique()->safeEmail,
                'birthdate' => $faker->date,
                'contact' => $faker->phoneNumber,
                'address' => $faker->address,
                'email_verified_at' => now(),
                'password' => bcrypt('test'),
                'is_verified' => "1",
                'user_type' => 'patient',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
