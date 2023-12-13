<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PatientFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail,
            'birthdate' => $this->faker->date,
            'contact' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // You can change this to whatever default password you want
            'is_verified' => $this->faker->randomElement([0, 1]),
            'user_type' => 'patient',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
