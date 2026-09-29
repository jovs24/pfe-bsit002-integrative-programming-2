# Week 4 – Validation

## Explanation of Validation Rules Used

The `EmployeeController` validates every request with `$request->validate()` before saving anything, so invalid data never reaches the database.

**Creating an employee (`POST /api/employees`):**

| Field | Rule | Meaning |
| --- | --- | --- |
| first_name | `required\|string\|max:100` | Must be given, must be text, at most 100 characters |
| last_name | `required\|string\|max:100` | Must be given, must be text, at most 100 characters |
| email | `required\|email\|unique:employees,email` | Must be a valid email address that no other employee already uses |
| department_id | `required\|exists:departments,id` | Must point to a department that exists in the `departments` table |
| position | `required\|string\|max:100` | Must be given, must be text, at most 100 characters |

**Updating an employee (`PUT /api/employees/{id}`):** the same rules apply, but `required` is replaced with `sometimes`. This means a field is only checked if it is sent, so I can update just one field, such as the position. The email rule becomes `unique:employees,email,{id}`, which ignores the employee being updated so they can keep their own email.

**When validation fails,** Laravel stops the request and returns **422 Unprocessable Content** with a JSON list of errors for each field. The controller also returns **404 Not Found** when the employee ID does not exist, and **201 Created** when a new employee is saved successfully.

## Reflection: Why is validation important in API development?

Validation is important because an API cannot trust the data it receives. Any client, such as Postman, a website, or another system, can send a request, and some of that data will be wrong, incomplete, or even harmful.

First, validation **protects the database**. Without it, my Employee API could save an employee with no name, an invalid email, or a department that does not exist. The `unique` and `exists` rules also stop duplicate emails and broken links between tables before they happen.

Second, validation **gives clear feedback to the client**. When I sent a POST request with a missing email in Postman, the API returned a 422 status code with a message saying exactly which field was wrong. This helps other developers fix their requests quickly instead of guessing.

Third, validation **improves security**. Limiting field length and type reduces the risk of bad input causing errors or being used to attack the system.

Through this lab, I learned that validation should be done on the server, even if the front end also checks the input, because the API is the last line of defense before data is stored.
