@include('/recursos/navbar')

<div class="container mx-auto p-4 mt-20">
    <h1
        class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Estos son Pedidos hechos con <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Pay Pal</mark>
    </h1>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table style="margin:2rem 0rem;" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    ID de la Transacción
                </th>
                <th scope="col" class="px-6 py-3">
                    ID del Cliente
                </th>
                <th scope="col" class="px-6 py-3">
                    Email del Cliente
                </th>
                <th scope="col" class="px-6 py-3">
                    Importe
                </th>
                <th scope="col" class="px-6 py-3">
                    Moneda
                </th>
                <th scope="col" class="px-6 py-3">
                    Status del Pedido
                </th>
                <th scope="col" class="px-6 py-3">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr
                    class="text-center odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $pedido->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $pedido->payer_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->payment_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->payer_email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->amount }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->currency }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->payment_status }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ URL('/pedidos/' . $pedido->id . '/edit') }}">Editar</a>
                        <form action="{{ URL('/pedidos/' . $pedido->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input style="cursor: pointer; color: red" type="submit" value="Eliminar"
                                onclick="return confirm('¿Desas eliminar este pedido?')" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pedidos->links() }}
</div>
