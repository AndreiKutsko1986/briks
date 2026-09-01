@echo off
cd /d "%~dp0"

echo.
echo ========================================
echo   Bricks Catalog (Laravel)
echo ========================================
echo.

where php >nul 2>&1
if errorlevel 1 (
    if exist "C:\xampp\php\php.exe" (
        set PHP=C:\xampp\php\php.exe
    ) else (
        echo PHP not found. Install XAMPP or add php to PATH.
        pause
        exit /b 1
    )
) else (
    set PHP=php
)

if not exist "vendor\" (
    echo Installing dependencies...
    composer install --no-interaction
)

if not exist ".env" (
    copy .env.example .env
    %PHP% artisan key:generate
)

if not exist "database\database.sqlite" (
    echo. > database\database.sqlite
)

%PHP% artisan migrate --force --seed
%PHP% artisan storage:link 2>nul

echo.
echo   Site:  http://localhost:8000
echo   Admin: http://localhost:8000/admin/login
echo   Login: admin@bricks.local / admin123
echo.
echo   Press Ctrl+C to stop
echo ========================================
echo.

%PHP% artisan serve --host=127.0.0.1 --port=8000
