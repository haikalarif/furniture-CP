# 🔧 Railway Quick Fix - NPM Error

## Problem
Error: `/bin/bash: line 1: npm: command not found`

## Solution
File `nixpacks.json` sudah diupdate untuk include Node.js dan NPM.

## What Changed

### nixpacks.json
```json
{
  "phases": {
    "setup": {
      "nixPkgs": [
        "php82",
        "php82Packages.composer",
        "nodejs_20",    // ← Added
        "npm-9_x"       // ← Added
      ]
    },
    "install": {
      "cmds": [
        "composer install --no-dev --optimize-autoloader --no-interaction",
        "npm install"   // ← Added
      ]
    },
    "build": {
      "cmds": [
        "npm run build" // ← Added
      ]
    }
  },
  "start": {
    "cmd": "php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -d variables_order=EGPCS artisan serve --host=0.0.0.0 --port=$PORT"
  }
}
```

## Deploy Steps

1. **Commit & Push**
```bash
git add .
git commit -m "Fix: Add Node.js and NPM to Railway build"
git push origin main
```

2. **Railway akan auto-deploy** atau manual redeploy di dashboard

3. **Build process akan:**
   - ✅ Install PHP 8.2
   - ✅ Install Node.js 20
   - ✅ Install NPM 9.x
   - ✅ Run `composer install`
   - ✅ Run `npm install`
   - ✅ Run `npm run build` (compile Vite assets)
   - ✅ Start server dengan migrations

## Expected Build Output

```
[1/10] Setup
  → Installing php82, nodejs_20, npm-9_x

[2/10] Install
  → composer install --no-dev --optimize-autoloader --no-interaction
  → npm install

[3/10] Build
  → npm run build
  → vite build
  → ✓ built in 2.5s

[4/10] Start
  → Running migrations...
  → Starting server...
```

## If Still Error

### Check 1: Verify Files Exist
```bash
ls -la package.json
ls -la vite.config.js
ls -la package-lock.json
```

### Check 2: Test Build Locally
```bash
npm install
npm run build
```

### Check 3: Railway Logs
1. Go to Railway Dashboard
2. Click your service
3. Tab "Deployments"
4. Click latest deployment
5. Check logs for specific error

## Common Issues

### Issue: "Cannot find module 'vite'"
**Solution**: Make sure `package.json` has vite in devDependencies

### Issue: "npm ERR! peer dependencies"
**Solution**: Already handled by `.npmrc` file

### Issue: Build takes too long
**Solution**: Normal for first build (5-10 minutes). Subsequent builds are faster.

## Files Added/Modified

- ✅ `nixpacks.json` - Added Node.js and NPM
- ✅ `.npmrc` - NPM configuration
- ✅ `RAILWAY_QUICK_FIX.md` - This file

## Next Steps After Successful Deploy

1. Set APP_URL in Railway variables
2. Run `railway run php artisan storage:link`
3. Test the website
4. Create admin user if needed

---

**Need help?** Check `DEPLOY_RAILWAY_STEP_BY_STEP.md` for complete guide.
