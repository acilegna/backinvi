<?php

namespace App\Http\Controllers;

//use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use App\Models\Invitado;
use Illuminate\Support\Facades\Validator;

use App\Imports\InvitadosImport;
use Maatwebsite\Excel\Facades\Excel;


//use App\Http\Requests\InvitadoRequest;


class ApiController extends Controller
{
    // Obtener todos los invitado s
    public function index()
    {
        return response()->json(Invitado::all(), 200);
    }
    // Crear un invitado
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_familia' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:10|unique:invitados,telefono',
            'categoria' => 'required|string',
            /*  'status' => 'required|string|max:2' */

        ], [
            'id_familia.required' => 'El id familia es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
            'telefono.max' => 'El campo teléfono no debe tener más de 10 caracteres.',
            'categoria.required' => 'La categoria es obligatorio.',
            'status.required' => 'El status es obligatorio.',
            /*   'status.max' => 'El campo status no debe tener más de 2 caracteres.', */

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $invitado = Invitado::create($request->all());
        return response()->json([
            'message' => 'Registro creado correctamente',
            'invitado' => $invitado
        ], 201);
    }

    // Actualizar un invitado
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:10',
            'categoria' => 'required|string|max:6',
            'status' => 'required|string|max:2'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El campo teléfono no debe tener más de 10 caracteres.',
            'categoria.required' => 'El correo electrónico es obligatorio.',
            'status.required' => 'El status es obligatorio.',
            'status.max' => 'El campo status no debe tener más de 2 caracteres.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $invitado = Invitado::find($id);
        if (!$invitado) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
        $invitado->update($request->all());
        return response()->json(['mensaje' => "Registro actualizado", 'info' => $invitado], 200);
    }




    // Mostrar un invitado por ID
    public function show($id)
    {
        $invitado = Invitado::find($id);
        if (!$invitado) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
        return response()->json($invitado, 200);
    }
    // Eliminar un invitado
    public function destroy($id)
    {
        $invitado = Invitado::find($id);
        if (!$invitado) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
        $invitado->delete();
        return response()->json(['message' => 'Registro  Eliminado'], 200);
    }
    // fin crud

    public function confirmados()
    {
        $confirmados = Invitado::where('status', 'Si')->count();
        return response()->json(['total_confirmados' => $confirmados], 200);
    }
    public function ausentes()
    {
        $confirmados = Invitado::where('status', 'No')->count();
        return response()->json(['total_ausentes' => $confirmados], 200);
    }

    public function totalInvitados()
    {
        $total = Invitado::all()->count();
        return response()->json(['total' => $total], 200);
    }

    public function pendientes()
    {
        $pendientes = Invitado::where('status', 'Pendiente')->count();
        return response()->json(['pendientes' => $pendientes], 200);
    }

    public function totalNiños()
    {
        $niños = Invitado::where('categoria', 'Niño')->count();
        return response()->json(['total' => $niños], 200);
    }

    public function totalAdulto()
    {
        $adulto = Invitado::where('categoria', 'Adulto')->count();
        return response()->json(['totalAdultos' => $adulto], 200);
    }
    public function niñosAusentes()
    {
        $niños = Invitado::where('categoria', 'Niño')->where('status', 'No')->count();
        return response()->json(['total' => $niños], 200);
    }

    public function adultosAusentes()
    {
        $adulto = Invitado::where('categoria', 'Adulto')->where('status', 'No')->count();
        return response()->json(['total' => $adulto], 200);
    }

    public function niñosConfirmados()
    {
        $niños = Invitado::where('categoria', 'Niño')->where('status', 'Si')->count();
        return response()->json(['total' => $niños], 200);
    }

    public function adultosConfirmados()
    {
        $adulto = Invitado::where('categoria', 'Adulto')->where('status', 'Si')->count();
        return response()->json(['total' => $adulto], 200);
    }


    public function niñosPendientes()
    {
        $niños = Invitado::where('categoria', 'Niño')->where('status', 'Pendiente')->count();
        return response()->json(['total' => $niños], 200);
    }

    public function adultosPendientes()
    {
        $adulto = Invitado::where('categoria', 'Adulto')->where('status', 'Pendiente')->count();
        return response()->json(['total' => $adulto], 200);
    }





    public function totalAdultoById()
    {
        $adultoId = Invitado::where('categoria', 'adulto')->where('id_familia', '1')->count();
        return response()->json(['totalAdultos' => $adultoId], 200);
    }

    public function totalNinoById()
    {
        $NinoId = Invitado::where('categoria', 'niño')->where('id_familia', '1')->count();
        return response()->json(['totalNino' => $NinoId], 200);
    }


    public function updateStatus($id, Request $request)
    {
        $invitado = Invitado::find($id);

        if (!$invitado) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $invitado->update($request->only(['status']));

        return response()->json(['mensaje' => 'Registro actualizado correctamente'], 200);
    }



    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        try {
            Excel::import(new InvitadosImport, $request->file('file'));
            return response()->json(['mensaje' => 'Importación exitosa'], 200);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return response()->json([
                'mensaje' => 'Errores en la importación',
                'errors' => $e->failures()

            ], 422);
        }
    }
    public function byFamily($id)
    {
        // Buscar TODOS los invitados 
        $todos = Invitado::where('id_familia', $id)->get();

        // Si no hay ningún invitado con esa familia
        if ($todos->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'Registro no encontrado'], 404);
        }

        // Filtrar los pendientes
        $pendientes = $todos->where('status', 'Pendiente')->sortBy('categoria')->values();

        // Si hay pendientes, devolverlos
        if ($pendientes->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'invitados' => $pendientes,
            ], 200);
        }

        // Si hay invitados pero ninguno pendiente
        return response()->json([
            'success' => false,
            'error' => 'Los invitados ya han sido confirmados',
        ], 409); 
    }


   

    /*        public function show($id)
    {
        $invitado = Invitado::find($id);
        if (!$invitado) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
        return response()->json($invitado, 200);
    } */
}
