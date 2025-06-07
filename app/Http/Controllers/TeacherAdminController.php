<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherAdminController extends Controller
{
    
public function index()
{
    $teachers = \App\Models\User::where('role', 'professor')->get();
    return view('admin.teachers.index', compact('teachers'));
}

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'professor',
        ]);
        return redirect()->route('teachers.index')->with('success', 'Profesor creado.');
    }

    public function show($id)
    {
        $teacher = User::where('role', 'professor')->findOrFail($id);
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = User::where('role', 'professor')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = User::where('role', 'professor')->findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$teacher->id,
            'password' => 'nullable|string|min:6',
        ]);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        if ($request->password) {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();
        return redirect()->route('teachers.index')->with('success', 'Profesor actualizado.');
    }

    public function destroy($id)
    {
        $teacher = User::where('role', 'professor')->findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Profesor eliminado.');
    }
}