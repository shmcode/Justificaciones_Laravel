<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
public function up()
{
    Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('classroom_id');
        $table->time('hora');
        $table->timestamps();
        $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
    });
}
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
};