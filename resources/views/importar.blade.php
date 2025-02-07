<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <title>Importar CSV</title>
</head>

<body>
    <div class="container-fluid">
        <h1 class="text-center title-upload">Subir Archivo</h1>

        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-10"><input type="file" class="form-control" name="file" required></div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
