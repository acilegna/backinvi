<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje</title>
    {{-- Cargar CSS con Vite --}}
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center title-upload">Enviar Invitación</h2>
        <form action="{{ route('send.whatsapp') }}" method="POST">
            @csrf
            <div class="col-4 row" id="btn-envia">
                <button type="submit" class="btn btn-outline-success"> Enviar</button>
            </div>

        </form>



    </div>

</body>

</html>
