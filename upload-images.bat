@echo off
echo ========================================
echo Upload Images to Railway
echo ========================================
echo.

echo Step 1: Checking storage folder...
if exist "storage\app\public\products" (
    echo [OK] Products folder found
) else (
    echo [ERROR] Products folder not found
    exit /b 1
)

if exist "storage\app\public\galleries" (
    echo [OK] Galleries folder found
) else (
    echo [ERROR] Galleries folder not found
    exit /b 1
)

echo.
echo Step 2: Adding images to git...
git add storage/app/public/

echo.
echo Step 3: Checking what will be committed...
git status

echo.
echo ========================================
echo Ready to commit!
echo ========================================
echo.
set /p confirm="Do you want to commit and push? (y/n): "

if /i "%confirm%"=="y" (
    echo.
    echo Committing...
    git commit -m "Add: Upload all storage images for Railway deployment"
    
    echo.
    echo Pushing to GitHub...
    git push origin main
    
    echo.
    echo ========================================
    echo SUCCESS! Images uploaded to GitHub
    echo Railway will auto-deploy in 3-5 minutes
    echo ========================================
) else (
    echo.
    echo Cancelled. No changes committed.
)

echo.
pause
