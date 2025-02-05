<!DOCTYPE html>
<html>


<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    @vite('resources/css/app.css')


</head>



<body>
    <div class="container-fluid valor">
        <img src="{{ asset('storage/images/1674-p.png') }}" class="rounded float-start" id="imag">
        <img src="{{ asset('storage/images/1674-s.png') }}" class="rounded float-end">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">



        <button type="button" class="btn btn-primary">CONFIRMAR</button>
        <h1 class="text-center" id="one">prueba</h1>
    </div>

</body>

</html>
