<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherAdminController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'professor')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

public function create()
{
    $facultades = \App\Models\Facultad::all();
    return view('admin.teachers.create', compact('facultades'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u'],
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@uamv\.edu\.ni$/i',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'
            ],
            'facultad_id' => ['required', 'exists:facultades,id'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debes ingresar un correo válido.',
            'email.regex' => 'El correo debe ser institucional (@uamv.edu.ni).',
            'email.unique' => 'Este correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener una mayúscula, una minúscula, un número y un símbolo.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'professor',
            'facultad_id' => $request->facultad_id,
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
            'name' => ['required', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u'],
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@uamv\.edu\.ni$/i',
                'unique:users,email,' . $teacher->id
            ],
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debes ingresar un correo válido.',
            'email.regex' => 'El correo debe ser institucional (@uamv.edu.ni).',
            'email.unique' => 'Este correo ya está registrado.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener una mayúscula, una minúscula, un número y un símbolo.',
        ]);

        $teacher->name = $request->name;
        $teacher->email = $request->email;

        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Profesor actualizado.');
    }


public function destroy($id)
{
    $teacher = User::findOrFail($id);

    // Elimina las justificaciones asociadas
    \App\Models\Justification::where('professor_id', $teacher->id)->delete();

    // Ahora elimina el profesor
    $teacher->delete();

    return redirect()->route('teachers.index')->with('success', 'Profesor eliminado correctamente.');
}
}