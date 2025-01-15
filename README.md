# Result Checker API

Result Checker is a RESTful API that allows users to check their results, manage user accounts, and for administrators to manage scratch cards and user accounts.

## Routes

### 1. Public Routes

-   **GET `/`**
    -   Returns a simple greeting message.
    -   **Response:**
        ```json
        {
            "message": "Hello, I'm API!!!"
        }
        ```

### 2. Auth Routes (Authentication)

-   **POST `/auth/register`**
    -   Registers a new user.
    -   **Request Body:**
        ```json
        {
            "email": "[email address removed]",
            "password": "password123",
            "name": "John Doe"
        }
        ```
-   **POST `/auth/login`**
    -   Logs in a user and returns an authentication token.
    -   **Request Body:**
        ```json
        {
            "email": "[email address removed]",
            "password": "password123"
        }
        ```
-   **POST `/auth/logout`**
    -   Logs out a user. Requires authentication via Sanctum.
    -   **Headers:**
        ```
        Authorization: Bearer <auth_token>
        ```

### 3. Admin Routes

These routes are protected and require authentication via Sanctum and the "admin" role.

-   **GET `/admin/users`**

    -   Fetches a list of all users.
    -   **Response:**
        -   List of users

-   **GET `/admin/scratch-cards`**

    -   Lists all the scratch cards available.

-   **POST `/admin/generate`**

    -   Generates a new scratch card.
    -   **Request Body:**
        ```json
        {
            "amount": 100
        }
        ```

-   **GET `/admin/account-types`**

    -   Fetches a list of account types.

-   **POST `/admin/results`**
    -   Allows admins to create results for users.
    -   **Request Body:**
        ```json
        {
            "user_id": 1,
            "result": "Pass"
        }
        ```

### 4. User Routes

These routes are protected and require authentication via Sanctum.

-   **GET `/user/check-result`**
    -   Allows a user to check their results.
    -   **Response:**
        -   User's result (if available)

**Authentication**

The API uses Sanctum for user authentication. Users must authenticate via login to access protected routes. Once logged in, the API will return an authentication token that must be included in the `Authorization` header as a `Bearer` token for any request to protected routes.

## Docker Setup Guide

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/Hordunlarmy/ResultChecker
cd your-repository-folder
```

### 2. Build the Docker Image

Once you're inside the project folder, build the Docker image:

```bash
docker compose up --build -d
```

### 3. Verify the Application

After the Docker image has been built successfully, you can verify the application by visiting [http://localhost:8000](http://localhost:8000) in your browser.

### 4. Generate Scratch Cards

To generate scratch cards, you can use the following command:

```bash
docker exec -it resultchecker php artisan scratchcards:generate 10
# Generates 10 scratch cards
```

## API Documentation

You can interact with the API using Postman. Here’s the link to the Postman collection for testing the available endpoints:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://documenter.getpostman.com/view/34544809/2sAYQZGBu9)

Live URL => https://xfinders.hordun.software/api

Feel free to import the collection and start testing the endpoints. The collection includes examples for common requests to help you get started.
