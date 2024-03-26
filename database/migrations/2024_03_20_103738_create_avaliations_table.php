<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliationsTable extends Migration
{

    public function up()
    {
        Schema::create('avaliations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('age');
            $table->date('date');
            $table->float('weight');
            $table->float('height');
            $table->text('observations_to_student')->nullable();
            $table->text('observations_to_nutritionist')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')->references('id')->on('files');
            $table->json('measures');
            $table->timestamps();


        });
    }


    public function down()
    {
        Schema::dropIfExists('avaliations');
    }
}
