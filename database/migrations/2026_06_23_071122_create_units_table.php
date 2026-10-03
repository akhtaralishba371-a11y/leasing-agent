<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('unit_number');
            $table->unsignedTinyInteger('bedrooms')->default(1);
            $table->decimal('bathrooms', 3, 1)->default(1);
            $table->unsignedInteger('square_feet')->nullable();
            $table->decimal('rent', 10, 2);
            $table->string('status')->default('available'); // available, leased, unavailable
            $table->date('available_on')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['property_id', 'unit_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
