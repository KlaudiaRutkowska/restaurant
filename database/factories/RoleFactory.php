<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = $this->faker->randomElement(['Administrator' => 'ADMIN', 'Employee' => 'WORKER', 'User' => 'USER']);
        
        return [
            'name' => $this->faker->name(),
            'roles' => $this->$roles,
        ];
    }
}
