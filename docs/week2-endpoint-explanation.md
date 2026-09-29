# Week 2 – Explanation of the Endpoint

`GET /api/students` is a simple REST endpoint that returns a list of two students as JSON.

| Part | Value |
| --- | --- |
| HTTP method | GET (reads data, does not change anything) |
| URL | http://127.0.0.1:8000/api/students |
| Status code | 200 OK |
| Response body | A JSON array of two students, each with `id`, `name`, and `course` |

The route is defined in `routes/api.php`. Laravel automatically adds the `/api` prefix to routes in this file. When Postman sends the request, Laravel matches the URL to the route and runs its function. The function calls `response()->json()`, which converts the PHP array into JSON and sets the `Content-Type: application/json` header.

The data is hardcoded and not yet from a database. The purpose of this lab is to practice how a client and server exchange data over HTTP: the client sends a request with a method and URL, and the server replies with a status code and a JSON body.
