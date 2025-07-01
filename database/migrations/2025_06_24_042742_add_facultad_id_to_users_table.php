<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('facultad_id')->nullable()->constrained('facultades');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['facultad_id']);
        $table->dropColumn('facultad_id');
    });
}
};