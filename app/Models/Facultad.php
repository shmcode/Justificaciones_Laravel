<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
        protected $table = 'facultades'; 

    protected $fillable = ['name'];

public function profesores()
{
    return $this->hasMany(User::class, 'facultad_id')->where('role', 'profesor');
}

    public function clases()
    {
        return $this->hasMany(Classroom::class, 'facultad_id');
    }
}