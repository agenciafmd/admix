<?php

namespace Agenciafmd\Admix\Database\Factories;

use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'is_active' => 1,
            'can_notify' => 1,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('secret'),
            'role_id' => null,
        ];
    }
}
