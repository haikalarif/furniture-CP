@echo off
echo ========================================
echo  Starting KalKayu Living Development
echo ========================================
echo.
echo This will open 2 terminal windows:
echo 1. Vite Dev Server (npm run dev)
echo 2. Laravel Server (php artisan serve)
echo.
echo Press any key to continue...
pause > nul

echo.
echo Starting Vite Dev Server...
start cmd /k "npm run dev"

timeout /t 3 > nul

echo Starting Laravel Server...
start cmd /k "php artisan serve"

echo.
echo ========================================
echo  Servers Started!
echo ========================================
echo.
echo Frontend: http://localhost:8000
echo Admin: http://localhost:8000/login
echo.
echo Press any key to exit...
pause > nul
