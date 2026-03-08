# Portfolio Backend API

## About
This project is the backend API for my personal portfolio website.
It is built using Laravel and provides endpoints for managing
projects, images, and admin authentication.

The frontend of this project is built using Vue.js.

## Requirements

- PHP 8.2+
- Composer
- MySQL / MariaDB

## Install Composer Dependencies

```
composer install
```

## Set Up Environment Variables

```
cp .env.example .env
```

## Generate an Application Key

```
php artisan key:generate
```

## Database Setup

Update your database configuration in `.env`:

DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=

Run migrations and seed the database:

php artisan migrate --seed

## Storage Link

To make uploaded images publicly accessible:

```
php artisan storage:link
```

## Run the Server

```
php artisan serve
```

## Admin Credential (Development Only)

```
email: admin@gmail.com
Password: password
```