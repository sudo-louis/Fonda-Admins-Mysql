@include('/recursos/navbar')

<div class="container mx-auto p-4 mt-20">
    <a class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 mb-4"
        href="{{ url('productos/create') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Añadir nuevos Productos
    </a>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table style="margin:2rem 0rem;" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Foto
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr
                    class="text-center odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $producto->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <center>
                            <img src="{{ asset('storage/uploads') . '/' . $producto->foto }}" width="100"
                                alt="imagen del producto">
                        </center>
                    </th>
                    <td class="px-6 py-4">
                        {{ $producto->nombre_producto }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $producto->descripcion }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $producto->cantidad_en_stock }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ $producto->precio }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ URL('/productos/' . $producto->id . '/edit') }}">Editar</a>
                        <form action="{{ URL('/productos/' . $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input style="cursor: pointer; color: red" type="submit" value="Eliminar"
                                onclick="return confirm('¿Desas eliminar este producto?')" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $productos->links() }}
</div>
