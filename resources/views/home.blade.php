@vite('resources/css/app.css')
<div class="container">
    <div class="vh-100 row justify-content-center align-items-center">
        <div class="row">
            <div class="col-6  cont-title">
                <div class="cont">
                    <h1 class="txt-title">Total Invitados</h1>
                    <span>{{ $datos['invitados']}}</span>
                  
                </div>

            </div>
            <div class="col-6 cont-title">
                <div class="cont">
                    <h2 class="txt-title">Confirmados</h2>
                    <span>{{ $datos['confirmados']}}</span>
                    
                </div>
            </div>
        </div>
        <div class="row" id="margin">
            <div class="col-6   cont-title">
                <div class="cont">
                    <h3 class="txt-title">Pendientes</h3>
                    <span>{{ $datos['pendientes']}}</span>
                </div>
            </div>
            <div class="col-6   cont-title">
                <div class="cont">
                    <h4 class="txt-title">No asistiran</h4>
                </div>
            </div>
        </div>
    </div>


</div>
