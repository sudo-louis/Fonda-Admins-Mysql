<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json(["productos" => $productos], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'cantidad_en_stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()], 400);
        }

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
            'precio' => number_format((float) $request->precio, 2, '.', ''),
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

        return response()->json(["producto" => $producto], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $producto = Producto::find($id);

            if (!$producto) {
                return response()->json(['message' => 'Producto no encontrado'], 404);
            }

            $validator = Validator::make($request->all(), [
                'nombre_producto' => 'nullable|string|max:100',
                'descripcion' => 'nullable|string|max:255',
                'cantidad_en_stock' => 'nullable|integer|min:0',
                'precio' => 'nullable|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => true, 'message' => $validator->errors()], 400);
            }

            if ($request->hasFile('foto')) {
                if ($producto->foto && file_exists(public_path('storage/' . $producto->foto))) {
                    unlink(public_path('storage/' . $producto->foto));
                }

                $foto = $request->file('foto');
                $fotoPath = 'uploads/' . time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('storage/uploads'), $fotoPath);
                $producto->foto = $fotoPath;
            }

            $producto->update([
                'nombre_producto' => $request->nombre_producto ?? $producto->nombre_producto,
                'descripcion' => $request->descripcion ?? $producto->descripcion,
                'cantidad_en_stock' => $request->cantidad_en_stock ?? $producto->cantidad_en_stock,
                'precio' => $request->precio !== null ? number_format((float) $request->precio, 2, '.', '') : $producto->precio
            ]);

            return response()->json(['message' => 'Producto actualizado con éxito', 'producto' => $producto], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Ocurrió un error al actualizar el producto. ' . $e->getMessage()], 500);
        }
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
