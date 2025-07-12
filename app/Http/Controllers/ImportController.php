<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\InvitadosImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invitado;

use App\Services\UltraMsgService;
use Livewire\Component;

use function Laravel\Prompts\alert;

class ImportController extends Controller
{


    protected $ultraMsgService;

    public function __construct(UltraMsgService $ultraMsgService)
    {
        $this->ultraMsgService = $ultraMsgService;
    }



    public function pruebas()
    {
        $pases= Invitado::totalAdultos();
        var_dump($pases);
       /*  $idUrl = session('mi_variable');
        $pases= Invitado::pasesById($idUrl);
        var_dump($pases); */
      
       /*   $Invitados = Invitado::totalInvitados();
        $Confirmados = Invitado::totalConfirmados();
        $Pendientes = $Invitados - $Confirmados;
        $datos = [
            'invitados' =>  $Invitados,
            'confirmados' =>  $Confirmados,
            'pendientes' =>  $Pendientes
        ];
        return view('home')->with('datos', $datos);  */
    }
    public function detalles( )
    {
        $idUrl = session('mi_variable');
       $pases= Invitado::pasesById($idUrl);
        return response()->json($pases); // Retorna JSON
    }

    public function sendMessage2(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);


        $response = $this->ultraMsgService->sendMessage($request->phone, $request->message);

        return response()->json($response);
    }


    public function linkInvitation()
    {
        $url = 'https://invitations-khaki.vercel.app/';
        $param = '?value=';
        $link = $url . $param;
        return $link;
    }

    public function sendMessage()
    {
        $datoInvitado = Invitado::datosInvitado();
        foreach ($datoInvitado  as $datos) {
            $id = $datos['id'];
            $phone = $datos['telefono'];
            $link = $this->linkInvitation();

            $mesage = $link . $id;
            $response = $this->ultraMsgService->sendMessage($phone,  $mesage);
        }
        return response()->json($response);
    }


    public function formImportar()
    {
        return view('importar');
    }

    public function getUrl()
    {
        //ejemplo
        // $urls = 'http://127.0.0.1:8000/?value=26';
        request()->fullUrl();
        $id = request()->query('value');
        session(['mi_variable' => $id]);
    }

    public function  confirmar(Request $request)
    {

        $idUrl = session('mi_variable');
        $statusInvitado = Invitado::statusInvitado($idUrl);
        if ($statusInvitado == 'No') {

            Invitado::updateStatus($idUrl);

            return response()->json(['mensaje' => "Gracias por su confirmación"]);
        } elseif ($statusInvitado == 'Si') {
            return response()->json(['mensaje' => "Su confirmación ya se encuentra registrada!"]);
        } else {
            return response()->json(['mensaje' => "ocurrio un error"]);
        }
    }

    public function enviaDtos(){
        //obtener la id del invitado
        $idUrl = session('mi_variable');
        Invitado::pasesById($idUrl);
        
    }

    public function  showInvitado()
    {
        $this->getUrl();
        return view('invitados');
    }

    //Importar a BD
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new InvitadosImport, $request->file('file'));

        //return back()->with('success', 'Archivo importado correctamente.');
        return response()->json(['message' => 'Archivo importado exitosamente'], 200);
    }
}
