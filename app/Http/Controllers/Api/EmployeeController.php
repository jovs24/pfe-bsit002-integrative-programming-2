<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    /**
     * Week 4: list all employees.
     */
    public function index(): JsonResponse
    {
        return response()->json(Employee::all());
    }

    /**
     * Week 4: create an employee.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    /**
     * Week 4: show one employee.
     */
    public function show(string $id): JsonResponse
    {
        $employee = Employee::find($id);

        if (! $employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    /**
     * Week 4: update an employee.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $employee = Employee::find($id);

        if (! $employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:employees,email,'.$id,
            'department' => 'sometimes|string|max:100',
            'position' => 'sometimes|string|max:100',
        ]);

        $employee->update($validated);

        return response()->json($employee);
    }

    /**
     * Week 4: delete an employee.
     */
    public function destroy(string $id): JsonResponse
    {
        $employee = Employee::find($id);

        if (! $employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
