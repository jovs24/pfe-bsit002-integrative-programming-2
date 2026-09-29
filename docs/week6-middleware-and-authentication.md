# Week 6 – Middleware and Token-Based Authentication

## Explanation of Middleware

Middleware is code that runs **between** an incoming request and the controller. It acts like a security guard at a door: it checks each request first and decides whether to let it through or reject it.

In my project, I used the `auth:sanctum` middleware in `routes/api.php` to protect a group of routes:

- `POST /api/logout`
- `GET`, `POST`, `PUT`, `PATCH`, and `DELETE` on `/api/employees`

When a request reaches one of these routes, the middleware looks for a valid token in the `Authorization: Bearer <token>` header.

- **Valid token:** the middleware identifies the user and passes the request to `EmployeeController` or `AuthController`.
- **Missing or invalid token:** the middleware stops the request and returns **401 Unauthorized** with the message `"Unauthenticated."`. The controller never runs.

The routes `POST /api/register`, `POST /api/login`, and `GET /api/students` are outside the group, so anyone can use them without a token.

The benefit of middleware is that the security check is written once and applied to many routes. I do not have to repeat login checks inside every controller method.

## Explanation of Token-Based Authentication

In token-based authentication, the user logs in once with their email and password, and the server gives back a **token**. The client then sends this token with every request instead of sending the password again.

My API uses **Laravel Sanctum** and works in these steps:

1. **Register or log in.** The client sends `POST /api/register` or `POST /api/login`. `AuthController` checks the password with `Hash::check()`. If it is wrong, the API returns 401 with "Invalid login credentials".
2. **Token is created.** If the login is correct, `$user->createToken('api-token')` creates a token. Sanctum saves a hashed copy in the `personal_access_tokens` table and returns the plain token to the client in the JSON response.
3. **Client sends the token.** In Postman, I put the token in the `Authorization` header as `Bearer <token>` when calling protected routes like `GET /api/employees`.
4. **Server checks the token.** The `auth:sanctum` middleware looks up the token in the database. If it matches, the request continues. If not, the API returns 401 Unauthorized.
5. **Log out.** `POST /api/logout` deletes the current token with `currentAccessToken()->delete()`, so that token can no longer be used.

This approach is **stateless**: the server does not need to remember a login session, because every request proves who the user is with its token. This makes it a good fit for APIs used by mobile apps, single-page apps, and other systems.

Sanctum tokens are different from **JWT** (JSON Web Tokens). A JWT stores the user's data inside the token itself and is verified with a signature, without checking the database. A Sanctum token is a random string checked against the database, which makes it simple to revoke on logout.
