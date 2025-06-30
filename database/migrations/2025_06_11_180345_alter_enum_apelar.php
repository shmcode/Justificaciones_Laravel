<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    \DB::statement("ALTER TABLE justifications MODIFY status ENUM('pendiente','aceptado','rechazado','apelado') NOT NULL DEFAULT 'pendiente'");
}

public function down()
{
    \DB::statement("ALTER TABLE justifications MODIFY status ENUM('pendiente','aceptado','rechazado') NOT NULL DEFAULT 'pendiente'");
}
};