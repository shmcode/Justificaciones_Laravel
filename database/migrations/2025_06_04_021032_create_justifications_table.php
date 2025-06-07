<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
public function up()
{
    Schema::create('justifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('classroom_id');
        $table->unsignedBigInteger('professor_id');
        $table->string('motivo');
        $table->text('comentario')->nullable();
        $table->string('archivo')->nullable();
        $table->enum('status', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
        $table->timestamps();

        $table->foreign('student_id')->references('id')->on('users');
        $table->foreign('classroom_id')->references('id')->on('classrooms');
        $table->foreign('professor_id')->references('id')->on('users');
    });
}
};