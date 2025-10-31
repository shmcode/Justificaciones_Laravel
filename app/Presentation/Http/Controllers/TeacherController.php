<?php

namespace App\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Application\Justifications\ListTeacherJustifications;

class TeacherController extends Controller
{
    public function __construct(
        private ListTeacherJustifications $listTeacherJustifications
    ) {}

    /**
     * Muestra la lista de justificaciones con filtros.
     */
    public function index()
    {
        $filters = [
            'status'       => request('status'),
            'classroom_id' => request('classroom_id'),
        ];

        $classrooms = Classroom::where('professor_id', Auth::id())->get();
        $justifications = ($this->listTeacherJustifications)(Auth::id(), $filters);

        return view('teacher.index', compact('justifications', 'classrooms'));
    }

    /**
     * Genera PDF con las mismas justificaciones filtradas.
     */
    public function reportePdf(Request $request)
    {
        $filters = [
            'status'       => $request->get('status'),
            'classroom_id' => $request->get('classroom_id'),
        ];

        $classrooms = Classroom::where('professor_id', Auth::id())->get();
        $justifications = ($this->listTeacherJustifications)(Auth::id(), $filters);

        $pdf = Pdf::loadView('teacher.report_pdf', [
            'justifications' => $justifications,
            'classrooms'     => $classrooms,
            'classroomId'    => $filters['classroom_id'],
            'status'         => $filters['status'],
        ]);

        return $pdf->download('reporte_justificaciones_'.now()->format('Ymd_His').'.pdf');
    }
}
