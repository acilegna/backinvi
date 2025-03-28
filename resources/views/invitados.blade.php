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


        {{-- Usamos AJAX   para hacer la llamada sin recargar la página. --}}
        <button id="btnConfirma" class="btn btn-success">Confirmar</button>
        <div class="respuesta"></div>
        <button type="button" id="btnModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">
            Abrir Modal
        </button>





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




            $("#btnModal").click(function() {

                $.ajax({
                    url: "{{ route('detalle') }}", // Ruta en Laravel
                    type: "GET",
                    data: {},

                    success: function(data) {
                        console.log(data);
                        // Llenar los datos en el modal

                        $("#pases").text(data);
                        //agregar atributo maximo a input maximo y pasarle el valor de 
                        $("#maximo").attr('max', data);

                        

                    }
                });
            });
        </script>

        <!-- Modal -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Confirmar asistencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Pases asignados: </strong><span id="pases"></span></p>
                        <p><strong>Pases a usar: </strong><span id="pases"></span></p>
                        <input type="number" min="0"   id="maximo" value="0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Agregar Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </div>

</body>

</html>