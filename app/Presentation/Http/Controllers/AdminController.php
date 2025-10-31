<?php

namespace App\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Application\Justifications\ListAllJustifications;
use App\Application\Justifications\AdminDecideJustification;

class AdminController extends Controller
{
    public function __construct(
        private ListAllJustifications $listAllJustifications,
        private AdminDecideJustification $adminDecide
    ) {}

    /**
     * Lista de justificaciones con filtros.
     */
    public function index(Request $request)
    {
        $filters = [
            'status'       => $request->get('status', ''),
            'classroom_id' => $request->get('classroom_id', ''),
        ];

        $justifications = ($this->listAllJustifications)($filters);
        $classrooms     = Classroom::all();

        return view('admin.index', [
            'justifications' => $justifications,
            'status'         => $filters['status'],
            'classrooms'     => $classrooms,
            'classroomId'    => $filters['classroom_id'],
        ]);
    }

    /**
     * Genera un PDF con las mismas justificaciones filtradas.
     */
    public function reportePdf(Request $request)
    {
        $filters = [
            'status'       => $request->get('status', ''),
            'classroom_id' => $request->get('classroom_id', ''),
        ];

        $justifications = ($this->listAllJustifications)($filters);
        $classrooms     = Classroom::all();

        $pdf = Pdf::loadView('admin.reporte_pdf', [
            'justifications' => $justifications,
            'status'         => $filters['status'],
            'classroomId'    => $filters['classroom_id'],
            'classrooms'     => $classrooms,
        ]);

        return $pdf->download('reporte_justificaciones_' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Acepta una justificación.
     */
    public function accept(Request $request, $id)
    {
        $request->validate(['respuesta_admin' => 'required|string|max:1000']);

        $this->adminDecide->accept((int) $id, $request->respuesta_admin);

        return back()->with('success', 'Justificación aceptada.');
    }

    /**
     * Rechaza una justificación.
     */
    public function reject(Request $request, $id)
    {
        $request->validate(['respuesta_admin' => 'required|string|max:1000']);

        $this->adminDecide->reject((int) $id, $request->respuesta_admin);

        return back()->with('success', 'Justificación rechazada.');
    }
}
