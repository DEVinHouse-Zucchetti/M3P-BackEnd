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
        Schema::create('meal_plans_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_plan_id')->nullable();
            $table->foreign('meal_plan_id')->references('id')->on('meal_plans');
            $table->string('title');
            $table->string('description');
            $table->time('hour');
            $table->enum('day', ['SEGUNDA', 'TERCA', 'QUARTA', 'QUINTA', 'SEXTA', 'SABADO', 'DOMINGO']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plans_schedule');
    }
};
