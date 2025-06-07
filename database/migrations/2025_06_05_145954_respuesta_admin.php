<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up()
{
    Schema::table('justifications', function ($table) {
        $table->text('respuesta_admin')->nullable();
    });
}
public function down()
{
    Schema::table('justifications', function ($table) {
        $table->dropColumn('respuesta_admin');
    });
}
};