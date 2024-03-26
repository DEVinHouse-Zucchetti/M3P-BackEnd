<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('users_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('users_students', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('student_id');
        });
    }
};
