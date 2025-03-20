<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id(); 
            $table->string('prenom');
            $table->string('nom');
            $table->string('CIN')->unique();
            $table->string('genre')->nullable();
            $table->string('email')->unique();
            $table->string('tel')->nullable();
            $table->date('debut');
            $table->date('fin');
            $table->text('details')->nullable();
            $table->string('path')->nullable();
            $table->date('date_naissance');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stagiaires');
    }
};
