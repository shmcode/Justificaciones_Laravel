<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{

public function create()
{
    $classrooms = \App\Models\Classroom::with('professor')->get();
    return view('student.create', compact('classrooms'));
}
   
public function index(Request $request)
{
    $query = Justification::where('student_id', auth()->id());
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }
    $justifications = $query->with('classroom', 'professor')->get();
    $status = $request->status ?? '';
    return view('student.index', compact('justifications', 'status'));
}

    public function store(Request $request)
    {

            Log::info('Intentando guardar justificación', $request->all());

        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'motivo' => 'required|string',
            'comentario' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);

        $justification = new Justification();
        $justification->student_id = Auth::id();
        $justification->classroom_id = $classroom->id;
        $justification->professor_id = $classroom->professor_id;
        $justification->motivo = $request->motivo;
        $justification->comentario = $request->comentario;

        if ($request->hasFile('archivo')) {
            $justification->archivo = $request->file('archivo')->store('justificaciones');
        }

        $justification->save();

    return redirect('/student')->with('success', 'Justificación enviada correctamente.');
    }
}