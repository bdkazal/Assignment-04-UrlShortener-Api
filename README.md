# Assignment : 04

### Name : S M Kazal Mahmood

### Email: kazalmahmood@gmail.com

# URL Shortener API (Laravel + Sanctum + MySQL)

A secure RESTful URL Shortener API built with **Laravel**, **Laravel Sanctum**,
and **MySQL**, supporting token-based authentication, user profile management,
authenticated CRUD for short URLs, ownership authorization, and public redirect handling.

---

## Features

- User registration
- User login with Sanctum token
- User logout
- Authenticated profile view
- Authenticated profile update
- Authenticated profile delete
- Short URL CRUD
- Unique short code generation
- Ownership control using Policy
- Public redirect using short code
- Click tracking
- Expiration support for short URLs

---

## Project Structure

app/ bootstrap/ config/ database/ public/ resources/ routes/ storage/

### Important Folders

- app/Http/Controllers/Api/ → API Controllers
- app/Http/Controllers/ → Redirect Controller
- app/Models/ → User and ShortUrl models
- app/Policies/ → ShortUrlPolicy
- database/migrations/ → Table structure
- routes/api.php → API route definitions
- routes/web.php → Public redirect route

---

## Database Structure

### users

- id
- name
- email
- password
- timestamps

### personal_access_tokens

- id
- tokenable_type
- tokenable_id
- name
- token
- abilities
- last_used_at
- expires_at
- timestamps

### short_urls

- id
- user_id (FK)
- original_url
- short_code (unique)
- clicks
- expires_at
- timestamps

---

## API Endpoints

### Auth

- POST /api/register
- POST /api/login
- POST /api/logout

### User Profile

- GET /api/user
- PUT /api/user
- PATCH /api/user
- DELETE /api/user

### Short URLs

- GET /api/urls
- POST /api/urls
- GET /api/urls/{url}
- PUT /api/urls/{url}
- PATCH /api/urls/{url}
- DELETE /api/urls/{url}

### Public Redirect

- GET /{short_code}

---

## Requirements

- PHP 8.x
- Composer
- MySQL / MariaDB
- Laravel 12
- Laravel Sanctum
- Postman or any API testing tool

---

## Setup Instructions

### 1) Clone Repository

git clone git clone https://github.com/bdkazal/YOUR_REPOSITORY_NAME.git

---

### 2) Install Dependencies

composer install

---

### 3) Configure Environment

cp .env.example .env  
php artisan key:generate

Update database credentials in `.env`:

DB_DATABASE=url_shortner_api  
DB_USERNAME=root  
DB_PASSWORD=

---

### 4) Run Migrations

php artisan migrate

---

### 5) Start Development Server

php artisan serve

Visit API base URL:

http://127.0.0.1:8000

---

## Authentication Notes

- Protected routes require **Bearer Token**
- Use login or register response token in Postman Authorization tab
- Set request header:
    - Accept: application/json

---

## Testing Notes

- Use `/api/...` routes for JSON API testing
- Use `/{short_code}` in browser or Postman for public redirect testing
- Redirect route returns:
    - 302 for successful redirect
    - 404 if short code is not found
    - 410 if short URL is expired
- Click count increases on successful redirect

---

## Notes

- Short codes are auto-generated using Laravel `Str::random()`
- Only the owner can view, update, or delete their short URLs
- Policy is used for authorization
- Deleting a user also deletes their related short URLs through cascade delete
- Expired short URLs are blocked from redirecting

---

## Author

Submitted by: S M Kazal Mahmood  
Email: kazalmahmood@gmail.com  
Batch: Batch 4 (Full stack Laravel Career Path with PHP, Vue.js & AI)
