<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\InvitadosImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invitado;

use App\Services\UltraMsgService;


class ImportController extends Controller
{


    protected $ultraMsgService;

    public function __construct(UltraMsgService $ultraMsgService)
    {
        $this->ultraMsgService = $ultraMsgService;
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

    public function sendMessage()
    {
        $datoInvitado = Invitado::datosInvitado();
        $link = 'https://invitations-khaki.vercel.app/';


        foreach ($datoInvitado  as $datos) {
            $id = $datos['id'];
            $phone = $datos['telefono'];
            var_dump($phone);

            $mesa = $link . "?val=" . $id;
            $response = $this->ultraMsgService->sendMessage($phone, $mesa);
        }
        return response()->json($response);
        /*  $response = $this->ultraMsgService->sendMessage($pone, $mesa);

        return response()->json($response); */
    }


    public function showForm()
    {
        return view('importar');
    }


    public function  showInvitado()
    {

        return view('invitados');
        //http://127.0.0.1:8000/?id=49
        /*   $url = request()->fullUrl();
        var_dump($url);


        $valor = request()->query('id');
        var_dump($valor); */
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


    public function  idInvita(Request $request)
    {
        $idInvitado = Invitado::idInvitado();
        foreach ($idInvitado as $id) {
            $url = 'https://invitations-khaki.vercel.app';
            $valor = $url . "?value=" . $id;

            var_dump($valor);
        }
    }
    public function  confirmar(Request $request) {}
}