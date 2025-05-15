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
        Schema::create('birthregistries', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_child');
            $table->string('name_of_parent');
            $table->date('date_of_birth');
            $table->string('family_no');
            $table->string('zone');
            $table->enum('gender', ['Male', 'Female', 'Other']);  // Add more options as needed
            $table->decimal('birth_weight', 5, 2);  // Stores weight like 3.50 (weight in kilograms)
            $table->string('place_of_birth');
            $table->boolean('is_registered')->default(false);
            $table->string('phone_number');
            $table->string('status')->default('null');
            $table->boolean('is_desease')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birthregistries');
    }
};
