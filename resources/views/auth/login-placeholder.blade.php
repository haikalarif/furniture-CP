<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Required - KalKayu Living</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">KalKayu Living</h1>
                <p class="text-gray-600">Setup Authentication</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-blue-900 mb-3">
                    <i class="fas fa-info-circle mr-2"></i>Setup Required
                </h2>
                <p class="text-blue-800 mb-4">
                    Laravel Breeze belum terinstall. Ikuti langkah berikut untuk mengaktifkan authentication:
                </p>
                
                <div class="bg-white rounded p-4 mb-4">
                    <p class="font-mono text-sm text-gray-800 mb-2">1. Install Laravel Breeze:</p>
                    <code class="block bg-gray-900 text-green-400 p-3 rounded text-sm overflow-x-auto">
composer require laravel/breeze --dev
                    </code>
                </div>

                <div class="bg-white rounded p-4 mb-4">
                    <p class="font-mono text-sm text-gray-800 mb-2">2. Install Breeze dengan Blade:</p>
                    <code class="block bg-gray-900 text-green-400 p-3 rounded text-sm overflow-x-auto">
php artisan breeze:install blade
                    </code>
                </div>

                <div class="bg-white rounded p-4 mb-4">
                    <p class="font-mono text-sm text-gray-800 mb-2">3. Install dependencies:</p>
                    <code class="block bg-gray-900 text-green-400 p-3 rounded text-sm overflow-x-auto">
npm install && npm run dev
                    </code>
                </div>

                <div class="bg-white rounded p-4">
                    <p class="font-mono text-sm text-gray-800 mb-2">4. Run migrations:</p>
                    <code class="block bg-gray-900 text-green-400 p-3 rounded text-sm overflow-x-auto">
php artisan migrate
                    </code>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-yellow-800">
                    <strong>Note:</strong> Setelah install Breeze, refresh halaman ini untuk login.
                </p>
            </div>

            <div class="text-center">
                <a href="/" class="text-blue-600 hover:text-blue-800">
                    ← Kembali ke Home
                </a>
            </div>

            <div class="mt-6 pt-6 border-t">
                <p class="text-sm text-gray-600 text-center">
                    Butuh bantuan? Baca <strong>SETUP_GUIDE.md</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
