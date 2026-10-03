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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('source')->nullable(); // website, walk-in, referral, zillow, etc.
            $table->string('status')->default('new'); // new, contacted, touring, applied, leased, lost
            $table->unsignedTinyInteger('desired_bedrooms')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->date('desired_move_in')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
