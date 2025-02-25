<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $datos['pedidos'] = Pedidos::paginate(4);
        return view('pedidos.index', $datos);
    }

    public function edit(string $id)
    {
        $pedido = Pedidos::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'payment_id' => 'required|max:255',
            'payer_id' => 'required|max:255',
            'payer_email' => 'required|max:255',
            'amount' => 'required|numeric',
            'currency' => 'required|max:255',
            'payment_status' => 'required|max:255',
        ]);

        $datospedidos = request()->except(['_token', '_method']);
        $imagen = $request->file('foto');
        if ($imagen && $imagen->isValid()) {
            $rutaCarpeta = 'storage/uploads';
            $nombreImagen = $imagen->getClientOriginalName();
            $request->file('foto')->move($rutaCarpeta, $nombreImagen);
            $datospedidos['foto'] = $nombreImagen;
        }

        Pedidos::where('id', '=', $id)->update($datospedidos);
        $producto = Pedidos::findOrFail($id);
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Pedidos::where('id', '=', $id)->delete();
        return redirect('pedidos');
    }
}
