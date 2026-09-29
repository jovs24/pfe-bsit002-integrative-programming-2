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
     * Week 5: eager-load the department relationship and support
     * ?search=, ?department_id=, and ?page= (10 per page).
     */
    public function index(Request $request): JsonResponse
    {
        $query = Employee::with('department');

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Week 4: create an employee. Validation matches Week 5's relationship
     * design, so `department_id` (not the legacy `department` string) is
     * what links an employee to a Department record.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:100',
        ]);

        $employee = Employee::create($validated)->load('department');

        return response()->json($employee, 201);
    }

    /**
     * Week 4: show one employee.
     */
    public function show(string $id): JsonResponse
    {
        $employee = Employee::with('department')->find($id);

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
            'department_id' => 'sometimes|exists:departments,id',
            'position' => 'sometimes|string|max:100',
        ]);

        $employee->update($validated);

        return response()->json($employee->load('department'));
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
