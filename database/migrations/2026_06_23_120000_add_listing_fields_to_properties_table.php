<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('property_type')->nullable()->after('city');
            $table->string('neighborhood')->nullable()->after('property_type');
            $table->string('image_url')->nullable()->after('description');
            $table->boolean('featured')->default(false)->after('image_url');
            $table->boolean('is_published')->default(true)->after('featured');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['property_type', 'neighborhood', 'image_url', 'featured', 'is_published']);
        });
    }
};
