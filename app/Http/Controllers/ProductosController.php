<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'cantidad_en_stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = 'uploads/' . time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('storage/uploads'), $fotoPath);
        }

        $producto = Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad_en_stock' => $request->cantidad_en_stock,
            'precio' => $request->precio,
            'foto' => $fotoPath
        ]);

        return response()->json(['message' => 'Producto creado con éxito', 'producto' => $producto], 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'cantidad_en_stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($producto->foto && file_exists(public_path('storage/' . $producto->foto))) {
                unlink(public_path('storage/' . $producto->foto));
            }

            $foto = $request->file('foto');
            $fotoPath = 'uploads/' . time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('storage/uploads'), $fotoPath);
            $producto->foto = $fotoPath;
        }

        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion = $request->descripcion;
        $producto->cantidad_en_stock = $request->cantidad_en_stock;
        $producto->precio = $request->precio;
        $producto->save();

        return response()->json(['message' => 'Producto actualizado con éxito', 'producto' => $producto], 200);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        if ($producto->foto && file_exists(public_path('storage/' . $producto->foto))) {
            unlink(public_path('storage/' . $producto->foto));
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }
}
