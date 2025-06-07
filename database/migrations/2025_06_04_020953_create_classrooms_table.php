<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
public function up()
{
    Schema::create('classrooms', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('professor_id');
        $table->timestamps();

$table->foreign('professor_id')->references('id')->on('users')->onDelete('cascade');    });
}
};