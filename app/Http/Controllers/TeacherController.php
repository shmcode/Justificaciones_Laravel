<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Justification;

class TeacherController extends Controller
{
    public function index()
{
    // Obtén los IDs de las clases que imparte el profesor autenticado
    $classroomIds = \App\Models\Classroom::where('professor_id', auth()->id())->pluck('id');

    // Obtén las justificaciones de esas clases
    $justifications = \App\Models\Justification::with('student', 'classroom')
        ->whereIn('classroom_id', $classroomIds)
        ->get();

    return view('teacher.index', compact('justifications'));
}
}