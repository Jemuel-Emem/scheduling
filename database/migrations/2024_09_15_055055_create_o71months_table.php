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
        Schema::create('o71months', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_child');
            $table->string('name_of_parent');
            $table->date('date_of_birth');
            $table->integer('age_in_month')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->integer('family_no');
            $table->string('zone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o71months');
    }
};
