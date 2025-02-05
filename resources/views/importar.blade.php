<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar CSV</title>
</head>

<body>
    <h1>Subir Archivo CSV</h1>
    {{--   @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif --}}
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Importar</button>
    </form>
</body>

</html>
