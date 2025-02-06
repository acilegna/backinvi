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

    public $valor;
    protected $ultraMsgService;

    public function __construct(UltraMsgService $ultraMsgService)
    {
        $this->ultraMsgService = $ultraMsgService;

        $this->valor = session('mi_variable');
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


    public function showForm()
    {
        return view('importar');
    }
    public function getUrl()
    {
        request()->fullUrl();
        $id = request()->query('value');

        session(['mi_variable' => $id]);
    }

    public function  confirmar()
    {
        $id = $this->valor;
        Invitado::updateStatus($id);
    }


    public function  showInvitado()
    {

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