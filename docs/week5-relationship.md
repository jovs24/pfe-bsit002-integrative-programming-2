# Week 5 – Explanation of the Relationship Used

I used a **one-to-many** relationship: one department has many employees, and each employee belongs to one department.

**In the database,** a migration adds a `department_id` column to the `employees` table as a foreign key that points to `id` in the `departments` table. The foreign key uses `onDelete('cascade')`, so if a department is deleted, its employees are deleted too.

**In the models,** both sides of the relationship are defined in Eloquent:

- `Department` has `employees()`, which returns `$this->hasMany(Employee::class)`.
- `Employee` has `department()`, which returns `$this->belongsTo(Department::class)`.

**In the API,** `EmployeeController` uses `Employee::with('department')` to load each employee's department in the same query (eager loading). Because of this, every employee in the JSON response includes a `department` object, such as `{"id": 1, "name": "IT"}`, instead of only a number. This also avoids the "N+1 problem" of running a separate query for every employee.

The relationship also makes filtering easy: `GET /api/employees?department_id=1` returns only the employees in the IT department. The same endpoint supports `?search=juan` to search by name or email, and returns 10 employees per page with `?page=`.
