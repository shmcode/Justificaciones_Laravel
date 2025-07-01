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
    $classroom_id = $request->classroom_id ?? '';

    $query = Justification::query();

    if ($status) {
        $query->where('status', $status);
    }

    if ($classroom_id) {
        $query->where('classroom_id', $classroom_id);
    }

    $justifications = $query->with('student', 'classroom', 'professor')->get();
    $classrooms = Classroom::all();

    return view('admin.index', compact('justifications', 'status', 'classrooms', 'classroom_id'));
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

    public function reportePdf(Request $request)
{
    $status = $request->input('status');

    $justifications = Justification::with(['student', 'classroom', 'professor'])
        ->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $pdf = Pdf::loadView('admin.reporte_pdf', compact('justifications'));

    return $pdf->download('reporte_justificaciones.pdf');
}
}