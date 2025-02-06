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



        {{--   <h1 class="text-center" id="one">pruebas</h1> --}}


        {{--      Usamos AJAX   para hacer la llamada sin recargar la página. --}}
        <button id="btnEjecutar" class="btn btn-success">Ejecutar</button>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $("#btnEjecutar").click(function() {
                $.ajax({
                    url: "{{ route('ejecutar.funcion') }}",
                    type: "GET",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert("Función ejecutada con éxito.");
                    },
                    error: function() {
                        alert("Hubo un error.");
                    }
                });
            });
        </script>



    </div>

</body>

</html>
