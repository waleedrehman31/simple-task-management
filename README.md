<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Simple Task Management Application

A clean, modular task management system built with **Laravel 12**, **Livewire 3**, and **Tailwind CSS**.
Supports task creation, updates, deletion, status marking, queued background jobs, and task import from Excel.

---

## Features

-   Task CRUD operations (Create, Read, Update, Delete)
-   Mark tasks as complete (with background notification job via Laravel Queues)
-   Import tasks from Excel (.xlsx, .csv)
-   Real-time updates with Livewire 3
-   Loading states for better UX
-   Fully tested using Pest
-   PSR-12 code styling with Laravel Pint

---

## Project Setup

Follow these steps to get the project running locally:

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/task-management.git

# 2. Change directory
cd task-management

# 3. Install Composer dependencies
composer install

# 4. Install NPM dependencies
npm install

# 5. Build frontend assets
npm run dev

# 6. Copy and configure .env
cp .env.example .env

# 7. Generate application key
php artisan key:generate

# 8. Run migrations
php artisan migrate

# 9. Start the queue worker (for background jobs)
php artisan queue:work

# 10. Start the local development server
php artisan serve
```

---

## Run Tests

Run the test suite using Pest:

```bash
php artisan test --testsuite=Feature
```

All feature tests are in `tests/Feature/`

---

## Technologies & Packages Used

| Purpose            | Package / Tool                                                 |
| :----------------- | :------------------------------------------------------------- |
| PHP Framework      | [Laravel 12](https://laravel.com)                              |
| Frontend Framework | [Livewire 3](https://livewire.laravel.com)                     |
| CSS Framework      | [Tailwind CSS](https://tailwindcss.com)                        |
| Excel/CSV Import   | [Laravel Excel (Maatwebsite)](https://docs.laravel-excel.com/) |
| Background Queues  | [Laravel Queues](https://laravel.com/docs/12.x/queues)         |
| Testing Framework  | [Pest PHP](https://pestphp.com)                                |
| Code Formatting    | [Laravel Pint](https://laravel.com/docs/12.x/pint)             |

---

## Directory Structure

| Location                          | Purpose                                      |
| :-------------------------------- | :------------------------------------------- |
| `app/Http/Livewire/Task`          | Livewire 3 components (e.g. `TaskList.php`)  |
| `app/Jobs/NotifyTaskComplete.php` | Queue job class for logging task completions |
| `app/Imports/TasksImport.php`     | Task import logic using Laravel Excel        |
| `resources/views/`                | Blade views and Livewire components          |
| `tests/Feature/`                  | Pest feature tests                           |
| `database/migrations/`            | Database schema definitions                  |

---

## Code Quality

-   **Code Formatting:** `./vendor/bin/pint --parallel`
-   **Tests:** `php artisan test --testsuite=Feature`
