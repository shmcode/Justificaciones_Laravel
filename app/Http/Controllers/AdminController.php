<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use App\Models\Classroom;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Muestra la lista de justificaciones con filtros de clase y estado.
     */
    public function index(Request $request)
    {
        // Recogemos los filtros
        $status      = $request->get('status', '');
        $classroomId = $request->get('classroom_id', '');

        // Construimos la consulta base
        $query = Justification::with('student', 'classroom', 'professor');

        // Aplicamos filtro por estado si existe
        if ($status) {
            $query->where('status', $status);
        }

        // Aplicamos filtro por clase si existe
        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        // Obtenemos resultados y todas las aulas (para el dropdown)
        $justifications = $query->get();
        $classrooms     = Classroom::all();

        // Enviamos también classroomId para que el dropdown conserve la selección
        return view('admin.index', [
            'justifications' => $justifications,
            'status'         => $status,
            'classrooms'     => $classrooms,
            'classroomId'    => $classroomId,
        ]);
    }

    /**
     * Genera el PDF con las mismas justificaciones filtradas.
     */
    public function reportePdf(Request $request)
    {
        // Recogemos los mismos filtros
        $status      = $request->get('status', '');
        $classroomId = $request->get('classroom_id', '');

        // Construimos la consulta base
        $query = Justification::with('student', 'classroom', 'professor');

        if ($status) {
            $query->where('status', $status);
        }
        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        // Obtenemos justificaciones y aulas
        $justifications = $query->get();
        $classrooms     = Classroom::all();

        // Generamos el PDF con la vista 'admin.reporte_pdf'
        $pdf = Pdf::loadView('admin.reporte_pdf', [
            'justifications' => $justifications,
            'status'         => $status,
            'classroomId'    => $classroomId,
            'classrooms'     => $classrooms,
        ]);

        // Forzamos descarga con nombre único
        return $pdf->download('reporte_justificaciones_'.now()->format('Ymd_His').'.pdf');
    }

    /**
     * Acepta una justificación.
     */
    public function accept(Request $request, $id)
    {
        $request->validate([
            'respuesta_admin' => 'required|string|max:1000',
        ]);

        $j = Justification::findOrFail($id);
        $j->status          = 'aceptado';
        $j->respuesta_admin = $request->respuesta_admin;
        $j->save();

        return redirect()->back()->with('success', 'Justificación aceptada.');
    }

    /**
     * Rechaza una justificación.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'respuesta_admin' => 'required|string|max:1000',
        ]);

        $j = Justification::findOrFail($id);
        $j->status          = 'rechazado';
        $j->respuesta_admin = $request->respuesta_admin;
        $j->save();

        return redirect()->back()->with('success', 'Justificación rechazada.');
    }
}
