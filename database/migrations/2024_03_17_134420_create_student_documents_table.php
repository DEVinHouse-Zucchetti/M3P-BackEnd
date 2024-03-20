<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDocumentsTable extends Migration
{

    public function up()
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('file_id');
            $table->timestamps();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_documents');
    }
}
