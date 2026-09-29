# Week 3 - Laboratory Activity 3: Design and Document an API

**Scenario:** Employee Management System

The system should allow users to view all employees, view one employee, add
an employee, update employee information, delete an employee, search an
employee by name, and filter employees by department.

## 1. API Title

Employee Management API

## 2. Base URL

```
http://127.0.0.1:8000/api/v1
```

> Note: this design document follows the module's Week 3 instructions and
> shows a versioned base URL (`/api/v1`) as the target design. The working
> implementation built in Weeks 4-6 (see `routes/api.php`) uses the
> unversioned `/api/...` paths given in the module's own Week 4-6 code
> samples. Adding the `v1` prefix later is a one-line change in
> `routes/api.php` (`Route::prefix('v1')->group(...)`) and does not require
> any change to the controllers.

## 3. Resources

- `employees`
- `departments`

## 4. Endpoints

| # | Method | Endpoint | Description |
|---|--------|----------|-------------|
| 1 | GET | `/employees` | View all employees (paginated) |
| 2 | GET | `/employees/{id}` | View one employee |
| 3 | POST | `/employees` | Add an employee |
| 4 | PUT / PATCH | `/employees/{id}` | Update employee information |
| 5 | DELETE | `/employees/{id}` | Delete an employee |
| 6 | GET | `/employees?search=juan` | Search employee by name/email |
| 7 | GET | `/employees?department_id=1` | Filter employees by department |
| 8 | GET | `/employees?page=2` | Paginate through results |

## 5. Sample Request Body

`POST /employees`

```json
{
  "first_name": "Juan",
  "last_name": "Dela Cruz",
  "email": "juan@example.com",
  "department_id": 1,
  "position": "Programmer"
}
```

## 6. Sample Response Body

`201 Created`

```json
{
  "id": 1,
  "first_name": "Juan",
  "last_name": "Dela Cruz",
  "email": "juan@example.com",
  "department_id": 1,
  "position": "Programmer",
  "created_at": "2026-09-23T10:00:00.000000Z",
  "updated_at": "2026-09-23T10:00:00.000000Z"
}
```

## 7. Status Code Plan

| Code | Meaning | Used when |
|------|---------|-----------|
| 200 | OK | Successful GET, PUT/PATCH, DELETE |
| 201 | Created | Successful POST |
| 400 | Bad Request | Malformed request |
| 401 | Unauthorized | Missing/invalid Sanctum token |
| 403 | Forbidden | Authenticated but not allowed |
| 404 | Not Found | Employee/department does not exist |
| 422 | Validation Error | Failed `$request->validate()` rules |
| 500 | Server Error | Unhandled server-side error |

## 8. API Documentation (Swagger / OpenAPI)

See [`openapi.yaml`](./openapi.yaml) in this same folder — it can be pasted
into [editor.swagger.io](https://editor.swagger.io) or opened with the
Swagger Editor / Laravel Swagger package for the required screenshot.
