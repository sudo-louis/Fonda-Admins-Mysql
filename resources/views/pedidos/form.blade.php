<div class="mb-5">
    <label for="payment_id" class="block mb-2 text-sm font-medium text-white dark:text-white">ID del Pedido:
    </label>
    <input type="text" id="payment_id" name="payment_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->payment_id) ? $pedido->payment_id : '' }}" rerquired />
</div>
<div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="apellido">ID del Comprador: </label>
    <input name="payer_id" id="payer_id" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->payer_id) ? $pedido->payer_id : '' }}" required />
</div>
<div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="payer_email">Email del Comprador:
    </label>
    <input name="payer_email" id="payer_email" type="email"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->payer_email) ? $pedido->payer_email : '' }}" required />
</div>
<div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="amount">Importe: </label>
    <input name="amount" id="amount" type="number" min="1"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->amount) ? $pedido->amount : '' }}" required />
</div>
<div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="currency">Moneda: </label>
    <input name="currency" id="currency" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->currency) ? $pedido->currency : '' }}" required />
</div>
<div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="payment_status">Status del Pago: </label>
    <input name="payment_status" id="payment_status" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ isset($pedido->payment_status) ? $pedido->payment_status : '' }}" required />
</div>
<a href="{{ URL('/pedidos') }}"
    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Regresar</a>
<button type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar
</button>
