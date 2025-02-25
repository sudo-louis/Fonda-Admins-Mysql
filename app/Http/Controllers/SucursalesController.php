<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $datos['sucursales']=Sucursales::paginate(4);
        return view('sucursales.index',$datos);
    }

    public function create()
    {
        return view('sucursales.create');
        return view('sucursal.create', compact('sucursal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'nombre_sucursal' => 'required|string|max:100|unique:sucursales,nombre_sucursal',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|regex:/^\d{5}$/',
            'horario' => 'required|string|max:50',
        ]);

        $datossucursal = request()->except('_token');
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datossucursal['foto'] = $nombreImagen;
        }

        Sucursales::insert($datossucursal);
        return redirect()->route('sucursales.index')->with('success', 'Sucursal registrado con éxito.');
    }

    public function edit(string $id)
    {
        $sucursal = Sucursales::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'nombre_sucursal' => 'string|max:100',
            'direccion' => 'string|max:255',
            'codigo_postal' => 'regex:/^\d{5}$/',
            'horario' => 'string|max:50',
        ]);

        $datossucursals = request()->except(['_token', '_method']);
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datossucursals['foto'] = $nombreImagen;
        }

        Sucursales::where('id', '=', $id)->update($datossucursals);
        $producto = Sucursales::findOrFail($id);
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Sucursales::where('id', '=', $id)->delete();
        return redirect('sucursales');
    }
}
