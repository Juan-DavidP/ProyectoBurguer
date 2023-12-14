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

    public function obtenerTodos()
    {
        $sql = "SELECT 
        idpedido, 
        fecha, 
        total, 
        fk_idcliente, 
        fk_idsucursal, 
        fk_idestado,
        metodo_pago FROM pedidos";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT 
        idpedido, 
        fecha, 
        total, 
        fk_idcliente, 
        fk_idsucursal, 
        fk_idestado,
        metodo_pago FROM pedidos WHERE idpedido = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            $this->metodo_pago = $lstRetorno[0]->metodo_pago;
            return $this;
        }
        return null;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedido WHERE idpedido =?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos(
            fecha,
            total,
            fk_idcliente,
            fk_idsucursal,
            fk_idestado
            metodo_pago
            ) VALUES (?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->total,
            $this->fk_idcliente,
            $this->fk_idsucursal,
            $this->fk_idestado,
            $this->metodo_pago
        ]);
        return $this->idpedido = DB::getpdo()->lastInsertId();
    }
}
