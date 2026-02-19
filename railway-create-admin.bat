@echo off
echo ========================================
echo Create Admin User for Railway
echo ========================================
echo.

echo This will create an admin user in Railway database
echo.

set /p admin_name="Enter admin name (default: Admin): "
if "%admin_name%"=="" set admin_name=Admin

set /p admin_email="Enter admin email (default: admin@kalkayu.com): "
if "%admin_email%"=="" set admin_email=admin@kalkayu.com

set /p admin_password="Enter admin password (default: password123): "
if "%admin_password%"=="" set admin_password=password123

echo.
echo Creating user with:
echo Name: %admin_name%
echo Email: %admin_email%
echo Password: %admin_password%
echo.

set /p confirm="Continue? (y/n): "
if /i not "%confirm%"=="y" (
    echo Cancelled.
    pause
    exit /b 0
)

echo.
echo Creating admin user...
echo.

railway run php artisan tinker --execute="$user = new App\Models\User(); $user->name = '%admin_name%'; $user->email = '%admin_email%'; $user->password = bcrypt('%admin_password%'); $user->save(); echo 'Admin user created successfully!';"

echo.
echo ========================================
echo Admin user created!
echo ========================================
echo.
echo Login credentials:
echo Email: %admin_email%
echo Password: %admin_password%
echo.
echo Login at: https://your-app.up.railway.app/login
echo.
pause
