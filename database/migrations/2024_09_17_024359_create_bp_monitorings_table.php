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
        Schema::create('bp_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('resident_name');
            $table->integer('age');
            $table->string('bp');
            $table->enum('level', ['normal', 'elevated', 'high', 'low']);
            $table->date('date');
            $table->string('phone_number');
            $table->date('date_of_birth'); // ✅ added
            $table->enum('gender', ['male', 'female', 'other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bp_monitorings');
    }
};
