<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index()
    {
        $datos['empleados']=Empleado::paginate(4);
        return view('empleados.index',$datos);
    }

    public function create()
    {
        return view('empleados.create');
        return view('empleado.create', compact('empleado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|max:255',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:255',
            'salario' => 'required|numeric',
            'fecha_contratacion' => 'required|',
        ]);

        $datosEmpleado = request()->except('_token');
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datosEmpleado['foto'] = $nombreImagen;
        }

        Empleado::insert($datosEmpleado);
        return redirect()->route('empleados.index')->with('success', 'Empleado registrado con éxito.');
    }

    public function edit(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|max:255',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:255',
            'salario' => 'required|numeric',
            'fecha_contratacion' => 'required|',
        ]);

        $datosEmpleados = request()->except(['_token', '_method']);
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datosEmpleados['foto'] = $nombreImagen;
        }

        Empleado::where('id', '=', $id)->update($datosEmpleados);
        $producto = Empleado::findOrFail($id);
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Empleado::where('id', '=', $id)->delete();
        return redirect('empleados');
    }
}
