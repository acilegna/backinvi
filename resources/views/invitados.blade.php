<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    <div class="container-fluid valor">
        <img src="{{ asset('storage/images/1674-p.png') }}" class="rounded float-start" id="imag">
        <img src="{{ asset('storage/images/1674-s.png') }}" class="rounded float-end">




        <h1 class="text-center" id="one">pruebas</h1>
        <a href="{{ route('change.status') }}">
            <button>Ejecutar Función</button>
        </a>

        {{--      Usamos AJAX   para hacer la llamada sin recargar la página. --}}
        <button id="btnConfirma" class="btn btn-success">Confirmar</button>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $("#btnConfirma").click(function() {
                $.ajax({
                    url: "{{ route('change.status') }}",
                    type: "get",
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
