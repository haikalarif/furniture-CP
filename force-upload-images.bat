@echo off
echo ========================================
echo FORCE Upload Images to Railway
echo ========================================
echo.

echo Step 1: Removing .gitignore that blocks images...
if exist "storage\app\public\.gitignore" (
    del "storage\app\public\.gitignore"
    echo [OK] .gitignore removed
) else (
    echo [INFO] .gitignore already removed
)

echo.
echo Step 2: Force adding all images...
git add storage/app/public/ -f

echo.
echo Step 3: Checking files to be committed...
git status

echo.
echo Files in storage:
dir storage\app\public\products /b 2>nul
dir storage\app\public\galleries /b 2>nul
dir storage\app\public\hero /b 2>nul

echo.
echo ========================================
echo Ready to commit!
echo ========================================
echo.
set /p confirm="Commit and push images? (y/n): "

if /i "%confirm%"=="y" (
    echo.
    echo Committing...
    git commit -m "Force add: Upload all storage images to Railway"
    
    echo.
    echo Pushing to GitHub...
    git push origin main
    
    echo.
    echo ========================================
    echo SUCCESS!
    echo ========================================
    echo.
    echo Next steps:
    echo 1. Wait 3-5 minutes for Railway to deploy
    echo 2. Check Railway logs for "storage link connected"
    echo 3. Refresh your website
    echo.
    echo If images still don't show:
    echo - Check TROUBLESHOOT_IMAGES.md
    echo - Verify APP_URL in Railway variables
    echo.
) else (
    echo.
    echo Cancelled.
)

echo.
pause
