<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->after('content');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
            $table->string('hero_theme')->default('default')->after('hero_subtitle');
            $table->string('hero_background')->nullable()->after('hero_theme');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_subtitle', 'hero_theme', 'hero_background']);
        });
    }
};
