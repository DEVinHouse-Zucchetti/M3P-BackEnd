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

        Schema::table('students', function (Blueprint $table) {

            $table->string('email', 255)->unique()->after('id');
            $table->date('date_birth')->nullable()->after('email');
            $table->string('contact', 20)->after('date_birth');
            $table->string('cpf')->unique()->after('contact');
            $table->string('cep', 20)->nullable();
            $table->string('city', 50)->nullable()->after('cep');
            $table->string('neighborhood', 50)->nullable()->after('city');
            $table->string('number', 30)->nullable()->after('neighborhood');
            $table->string('street', 30)->nullable()->after('number');
            $table->string('state', 2)->nullable()->after('street');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('date_birth');
            $table->dropColumn('contact');
            $table->dropColumn('cpf');
            $table->dropColumn('city');
            $table->dropColumn('neighborhood');
            $table->dropColumn('number');
            $table->dropColumn('street');
            $table->dropColumn('state');
            $table->dropColumn('cep');
        });
    }
};
