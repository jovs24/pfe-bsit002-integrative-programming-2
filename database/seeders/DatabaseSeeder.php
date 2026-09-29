<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with demo data matching the
     * Week 6 Postman walkthrough in the module (register/login example).
     */
    public function run(): void
    {
        // Week 6 lab: admin@example.com / password123
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Week 5 lab: a few departments, each with employees.
        $it = Department::factory()->create(['name' => 'IT']);
        $hr = Department::factory()->create(['name' => 'Human Resources']);
        Department::factory()->create(['name' => 'Accounting']);

        Employee::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'juan@example.com',
            'department' => 'IT',
            'department_id' => $it->id,
            'position' => 'Programmer',
        ]);

        Employee::factory()->create([
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'email' => 'maria@example.com',
            'department' => 'Human Resources',
            'department_id' => $hr->id,
            'position' => 'HR Officer',
        ]);

        Employee::factory(8)->create();
    }
}
