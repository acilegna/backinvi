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
        'status',

    ];

    public static function idInvitado()
    {
        return self::pluck('id');
    }
    public static function datosInvitado()
    {

        return self::get(['id', 'telefono']);
    }

    public static function updateStatus($id)
    {

        return self::where('id', '=', $id)->update(['status' => 'si']);
    }
}