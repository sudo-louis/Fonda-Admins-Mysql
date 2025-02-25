<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Sucursales;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::paginate(5);

        $scdb = Sucursales::all();

        return view('clientes.index', compact("clientes", "scdb"));
    }

    public function create()
    {
        $scdb = Sucursales::all();
        return view('clientes.create', compact('scdb'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'nombres' => 'string|max:255',
            'apellidos' => 'string|max:255',
            'email' => 'email|unique:clientes,email',
            'sucursal_id' => 'exists:sucursales,id',
        ]);

        $datoscliente = request()->except('_token');
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datoscliente['foto'] = $nombreImagen;
        }

        Clientes::insert($datoscliente);
        return redirect()->route('clientes.index')->with('success', 'cliente registrado con éxito.');
    }


    public function edit(string $id)
    {
        $cliente = Clientes::findOrFail($id);
        $scdb = Sucursales::all();
        return view('clientes.edit', compact('cliente', "scdb"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'nombres' => 'string|max:255',
            'apellidos' => 'string|max:255',
            'email' => 'email|max:255',
            'sucursal_id' => 'exists:sucursales,id',
        ]);

        $datosclientes = request()->except(['_token', '_method']);
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datosclientes['foto'] = $nombreImagen;
        }

        Clientes::where('id', '=', $id)->update($datosclientes);
        $cliente = Clientes::findOrFail($id);
        return redirect()->route('clientes.index')->with('success', 'cliente actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Clientes::where('id', '=', $id)->delete();
        return redirect('clientes');
    }
}
