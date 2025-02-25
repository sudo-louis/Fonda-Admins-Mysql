@include('/recursos/navbar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Producto</title>
</head>

<body>
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
            role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form style="background-color: #4e4e51; padding: 2rem; border-radius:9px;"
        action="{{ URL('/pedidos/' . $pedido->id) }}" enctype="multipart/form-data" method="POST"
        class="max-w-sm mx-auto text-center mt-5">
        @csrf
        @method('PATCH')
        @include('pedidos.form')
    </form>
</body>

</html>
