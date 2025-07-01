<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Justification;
use App\Models\Classroom;

class TeacherController extends Controller
{
    /**
     * Muestra la lista de justificaciones con filtros de clase y estado.
     */
    public function index()
    {
        // IDs de las clases que imparte este profesor
        $classroomIds = Classroom::where('professor_id', Auth::id())->pluck('id');

        // Clases para el dropdown de filtro
        $classrooms = Classroom::whereIn('id', $classroomIds)->get();

        // Justificaciones de esas clases, aplicando filtros si existen
        $justifications = Justification::with('student', 'classroom')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->when(request('classroom_id'), fn($q) => $q->where('classroom_id', request('classroom_id')))
            ->whereIn('classroom_id', $classroomIds)
            ->get();

        return view('teacher.index', compact('justifications', 'classrooms'));
    }

    /**
     * Genera un PDF con las mismas justificaciones filtradas.
     */
    public function reportePdf(Request $request)
    {
        // Recogemos filtros
        $classroomId = $request->get('classroom_id');
        $status      = $request->get('status');

        // IDs de las clases de este profesor
        $classroomIds = Classroom::where('professor_id', Auth::id())->pluck('id');

        // Consulta con filtros
        $justifications = Justification::with('student', 'classroom')
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($classroomId, fn($q) => $q->where('classroom_id', $classroomId))
            ->whereIn('classroom_id', $classroomIds)
            ->get();

        // Para mostrar el nombre de la clase en la cabecera del PDF
        $classrooms = Classroom::whereIn('id', $classroomIds)->get();

        // Cargar la vista y generar el PDF
        $pdf = Pdf::loadView('teacher.report_pdf', [
            'justifications' => $justifications,
            'classrooms'     => $classrooms,
            'classroomId'    => $classroomId,
            'status'         => $status,
        ]);

        // Descargar con nombre único
        return $pdf->download('reporte_justificaciones_'.now()->format('Ymd_His').'.pdf');
    }
}
