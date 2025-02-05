<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje</title>
</head>

<body>
    <h2>Enviar Mensaje por WhatsApp</h2>
    <form action="{{ route('send.whatsapp') }}" method="POST">
        @csrf
        {{--  <label for="phone">Número:</label>
        <input type="text" name="phone" required>
        <br>
        <label for="message">Mensaje:</label>
        <textarea name="message" required></textarea>
        <br> --}}
        <button type="submit">Enviar</button>
    </form>

</body>

</html>
