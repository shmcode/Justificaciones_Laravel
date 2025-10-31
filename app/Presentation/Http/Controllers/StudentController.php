<?php
namespace App\Presentation\Http\Controllers;

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
        $facultades = \App\Models\Facultad::select('id', 'name')->get();
        $classrooms = \App\Models\Classroom::with('professor')->get();

        $facultadesData = $facultades->map(function ($fac) use ($classrooms) {
            $clases = $classrooms->where('facultad_id', $fac->id);

            $profesores = $clases->pluck('professor')->unique('id')->values()->map(function ($prof) use ($clases) {
                return [
                    'id'     => $prof->id,
                    'name'   => $prof->name,
                    'clases' => $clases->where('professor_id', $prof->id)->map(function ($clase) {
                        return [
                            'id'   => $clase->id,
                            'name' => $clase->name,
                        ];
                    })->values(),
                ];
            });

            return [
                'id'         => $fac->id,
                'name'       => $fac->name,
                'profesores' => $profesores,
            ];
        });

        return view('student.create', [
            'facultades' => $facultadesData,
        ]);
    }

    public function index(Request $request)
    {
        $studentId = Auth::id();
        if (!$studentId) {
            return redirect()->route('login');
        }

        $query = Justification::where('student_id', $studentId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->classroom_id);
        }

        $justifications = $query->with('classroom', 'professor')->get();

        // URL pública del archivo
        $justifications->each(function ($j) {
            $j->archivo_url = $j->archivo ? Storage::url($j->archivo) : null;
        });

        $status = $request->status ?? '';

        $classrooms = \App\Models\Classroom::whereIn(
            'id',
            Justification::where('student_id', $studentId)->pluck('classroom_id')
        )->get();

        return view('student.index', compact('justifications', 'status', 'classrooms'));
    }

    public function store(Request $request)
    {
        Log::info('Intentando guardar justificación', $request->all());

        $studentId = Auth::id();
        if (!$studentId) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'motivo'       => 'required|string|max:255',
            'comentario'   => 'required|string|max:1000',
            'archivo'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'classroom_id.required' => 'Debes seleccionar una clase.',
            'classroom_id.exists'   => 'La clase seleccionada no existe.',
            'motivo.required'       => 'El motivo es obligatorio.',
            'motivo.max'            => 'El motivo no puede tener más de 255 caracteres.',
            'comentario.required'   => 'El comentario es obligatorio.',
            'comentario.max'        => 'El comentario no puede tener más de 1000 caracteres.',
            'archivo.file'          => 'El archivo debe ser un archivo válido.',
            'archivo.mimes'         => 'El archivo debe ser PDF, JPG, JPEG o PNG.',
            'archivo.max'           => 'El archivo no debe pesar más de 2MB.',
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);

        $justification = new Justification();
        $justification->student_id   = $studentId;
        $justification->classroom_id = $classroom->id;
        $justification->professor_id = $classroom->professor_id;
        $justification->motivo       = $request->motivo;
        $justification->comentario   = $request->comentario;

        if ($request->hasFile('archivo')) {
            $justification->archivo = $request->file('archivo')->store('justificaciones', 'public');
        }

        $justification->save();

        return redirect('/student')->with('success', 'Justificación enviada correctamente.');
    }

    public function apelaciones()
    {
        $studentId = Auth::id();
        if (!$studentId) {
            return redirect()->route('login');
        }

        $justifications = Justification::where('student_id', $studentId)
            ->where(function ($q) {
                $q->where('status', 'rechazado')
                  ->orWhere('status', 'apelado');
            })
            ->where('updated_at', '>=', now()->subDays(7))
            ->with(['classroom', 'professor'])
            ->get();

        $justifications->each(function ($j) {
            $j->archivo_url = $j->archivo ? Storage::url($j->archivo) : null;
        });

        return view('student.apelaciones', compact('justifications'));
    }

    public function apelar(Request $request, $id)
    {
        $studentId = Auth::id();
        if (!$studentId) {
            return redirect()->route('login');
        }

        $request->validate([
            'motivo_apelacion'  => 'required|string|max:255',
            'archivo_apelacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $justification = Justification::where('id', (int)$id)
            ->where('student_id', $studentId)
            ->where('status', 'rechazado')
            ->where('updated_at', '>=', now()->subDays(7))
            ->firstOrFail();

        $justification->comentario = $request->motivo_apelacion;
        $justification->status     = 'apelado';

        if ($request->hasFile('archivo_apelacion')) {
            $justification->archivo = $request->file('archivo_apelacion')->store('justificaciones', 'public');
        }

        $justification->save();

        return redirect('/student/apelaciones')->with('success', 'Apelación enviada correctamente.');
    }
}
