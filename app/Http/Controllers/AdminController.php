<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{


 
public function index(Request $request)
{
    $status = $request->status ?? '';
    $query = Justification::query();

    if ($status) {
        $query->where('status', $status);
    }

    $justifications = $query->with('student', 'classroom', 'professor')->get();
        $classrooms = \App\Models\Classroom::all();


    return view('admin.index', compact('justifications', 'status', 'classrooms'));
}

   
public function accept(Request $request, $id)
{
    $request->validate([
        'respuesta_admin' => 'required|string|max:1000'
    ]);
    $justification = Justification::findOrFail($id);
    $justification->status = 'aceptado';
    $justification->respuesta_admin = $request->respuesta_admin;
    $justification->save();
    return redirect()->back()->with('success', 'Justificación aceptada.');
}

public function reject(Request $request, $id)
{
    $request->validate([
        'respuesta_admin' => 'required|string|max:1000'
    ]);
    $justification = Justification::findOrFail($id);
    $justification->status = 'rechazado';
    $justification->respuesta_admin = $request->respuesta_admin;
    $justification->save();
    return redirect()->back()->with('success', 'Justificación rechazada.');
}

    public function reportePdf()
{
    $justifications = \App\Models\Justification::with('student', 'classroom', 'professor')->get();
    $pdf = Pdf::loadView('admin.reporte_pdf', compact('justifications'));
    return $pdf->download('reporte-justificaciones.pdf');
}
}