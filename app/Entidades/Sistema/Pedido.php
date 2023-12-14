<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'fecha', 'total', 'fk_idcliente', 'fk_idsucursal', 'fk_idestado', 'metodo_pago'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request){
        $this->idpedido = $request->input('id');
    }
}
