<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    
public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

public function classroom()
{
    return $this->belongsTo(Classroom::class);
}

public function professor()
{
    return $this->belongsTo(User::class, 'professor_id');
}
}