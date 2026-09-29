<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'department_id' => \App\Models\Department::inRandomOrder()->first()?->id ?? Department::factory(),
            'position' => fake()->randomElement([
                'Programmer', 'QA Tester', 'Business Analyst', 'Project Manager', 'System Administrator',
            ]),
        ];
    }
}
