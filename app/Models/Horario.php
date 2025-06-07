<?php
// app/Models/Horario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['classroom_id', 'hora'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}