@echo off
echo ========================================
echo Railway Health Check
echo ========================================
echo.

echo [1] Checking Railway connection...
railway whoami
if %errorlevel% neq 0 (
    echo ERROR: Not logged in to Railway!
    echo Run: railway login
    pause
    exit /b 1
)
echo ✓ Connected to Railway
echo.

echo [2] Checking environment variables...
railway variables
echo.

echo [3] Checking APP_URL...
railway run php artisan config:show app.url
echo.

echo [4] Checking database connection...
railway run php artisan db:show
echo.

echo [5] Checking storage directories...
echo.
echo Checking storage/app/public:
railway run ls -la storage/app/public
echo.
echo Checking public/storage symlink:
railway run ls -la public/storage
echo.

echo [6] Checking recent logs...
railway logs --lines 50
echo.

echo ========================================
echo Health check completed!
echo ========================================
echo.
pause
