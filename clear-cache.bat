@echo off
echo ========================================
echo  Clearing Laravel Cache
echo ========================================
echo.

echo [1/5] Clearing application cache...
php artisan cache:clear

echo [2/5] Clearing config cache...
php artisan config:clear

echo [3/5] Clearing route cache...
php artisan route:clear

echo [4/5] Clearing view cache...
php artisan view:clear

echo [5/5] Clearing all optimizations...
php artisan optimize:clear

echo.
echo ========================================
echo  Cache Cleared Successfully!
echo ========================================
echo.
echo Now restart your servers:
echo 1. npm run dev
echo 2. php artisan serve
echo.
pause
