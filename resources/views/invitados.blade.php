<!DOCTYPE html>
<html>

<head>

    @vite('resources/css/app.css')

</head>

<body>
    <div class="container-fluid valor">
        <img src="{{ asset('storage/images/1674-p.png') }}" class="rounded float-start" id="imag">
        <img src="{{ asset('storage/images/1674-s.png') }}" class="rounded float-end">




        <h1 class="text-center" id="one">pruebasss</h1>


        {{--      Usamos AJAX   para hacer la llamada sin recargar la página. --}}
        <button id="btnConfirma" class="btn btn-success">Confirmar</button>
        <div class="respuesta"></div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $("#btnConfirma").click(function() {
                $.ajax({
                    url: "{{ route('change.status') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        $(".respuesta").html(`<div class="mensaje exito">${response.mensaje}</div>`);

                    },
                    error: function() {

                        $(".respuesta").html(`<div class="mensaje error">${response.mensaje}</div>`);
                    }
                });
            });
        </script>



    </div>

</body>

</html>
