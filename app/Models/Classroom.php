<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    
public function professor()
{
    return $this->belongsTo(User::class, 'professor_id');
}

public function justifications()
{
    return $this->hasMany(\App\Models\Justification::class);
}

public function horarios()
{
    return $this->hasMany(Horario::class);
}
}