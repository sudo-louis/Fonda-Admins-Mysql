<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $datos['productos'] = Producto::paginate(4);
        return view('productos.index', $datos);
    }

    public function create()
    {
        return view('productos.create');
        return view('producto.create', compact('producto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'cantidad_en_stock' => 'required|numeric',
            'precio' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
        ]);

        $datosProducto = request()->except('_token');
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datosProducto['foto'] = $nombreImagen;
        }

        Producto::insert($datosProducto);
        return redirect()->route('productos.index')->with('success', 'Producto registrado con éxito.');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'cantidad_en_stock' => 'required|numeric',
            'precio' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
        ]);

        $datosProductos = request()->except(['_token', '_method']);
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datosProductos['foto'] = $nombreImagen;
        }

        Producto::where('ID', '=', $id)->update($datosProductos);
        $producto = Producto::findOrFail($id);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Producto::where('ID', '=', $id)->delete();
        return redirect('productos');
    }
}
