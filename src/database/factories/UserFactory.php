<?php

namespace Admix\Database\Factories;

use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }
}