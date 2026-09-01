# Bricks Catalog

Laravel-based LEGO parts catalog (BrickLink-style), structured like a standard Laravel app.

## Quick start (Windows)

1. Copy this folder to `C:\Users\AndreiKutsko\OneDrive\bricks\`
2. Double-click **`start.bat`**

That's it. The script will:
- Install Composer dependencies (first run)
- Create SQLite database (zero MySQL setup required)
- Run migrations and seed sample data
- Start the site at **http://localhost:8000**

**Admin:** http://localhost:8000/admin/login  
**Login:** `admin@bricks.local` / `admin123`

## Using your local MySQL instead of SQLite

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bricks
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then run:

```cmd
php artisan migrate:fresh --seed
php artisan serve
```

## XAMPP (no artisan serve)

Point Apache document root to the `public` folder:

```
C:\Users\AndreiKutsko\OneDrive\bricks\public
```

Run once:

```cmd
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

## Features

- Public catalog with search, categories, item pages, price guide
- Admin panel: items, categories, listings CRUD
- JSON API: `GET /api/items?q=brick`
- SQLite by default (works immediately) or MySQL

## Project structure (Laravel)

```
app/Models/          Eloquent models
app/Http/Controllers/  Public + Admin controllers
database/migrations/ Database schema
database/seeders/    Sample data
resources/views/     Blade templates
public/              Web root (Apache DocumentRoot)
routes/web.php       Routes
start.bat            One-click Windows launcher
```
