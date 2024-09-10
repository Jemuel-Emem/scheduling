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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->integer('age');
            $table->string('address');
            $table->text('purpose');
            $table->date('date_schedule');
            $table->time('time_schedule');
            $table->enum('health_condition', ['highblood', 'pregnant', 'other']);
            $table->enum('health_status', ['healthy', 'under-treatment', 'chronic-condition']);
            $table->string('blood_pressure')->nullable();
            $table->enum('reschedule_option', ['none', 'date']);
            $table->date('reschedule_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
