<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    //
    protected $table = 'invitados';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable =
    [
        'name',
        'apellido',
        'email',
        'telefono',
        'pases',
        'confirmados',
        'status',
    ];


    public static function datosInvitado()
    {
        //self se refiere a la propia clase del modelo donde está definida la función.
        return self::get(['id', 'telefono']);
    }

    public static function updateStatus($id)
    {
        return self::where('id', '=', $id)->update(['status' => 'Si']);
    }

    public static function statusInvitado($id)
    {
        return self::where('id', $id)->value('status');
    }

    public static function vistaInvitado()
    {
        return self::get(['name', 'apellido', 'status']);
    }
    
    public static function totalInvitados()
    {
        return self::sum('pases');
    }
    public static function totalConfirmados()
    {
        return self::sum('confirmados');
    }

}