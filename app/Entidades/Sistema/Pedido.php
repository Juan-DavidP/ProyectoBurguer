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

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->fk_idestado = $request->input('lstEstado');
        $this->metodo_pago = $request->input('lstMetodoPago');
    }

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

    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT 
                    idpedido, 
                    fecha, 
                    total, 
                    fk_idcliente, 
                    fk_idsucursal, 
                    fk_idestado,
                    metodo_pago,
                    comentario
                FROM pedidos
                WHERE fk_idcliente= $idCliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorProducto($idProducto)
    {
        $sql = "SELECT 
                p.idpedido, 
                p.fecha, 
                p.total, 
                p.fk_idcliente, 
                p.fk_idsucursal, 
                p.fk_idestado,
                p.metodo_pago
            FROM pedidos p
            INNER JOIN clientes c ON p.fk_idcliente = c.idcliente
            INNER JOIN productos_pedidos pp ON p.idpedido = pp.fk_idpedido
            WHERE pp.fk_idproducto = $idProducto";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorSucursal($idSucursal)
    {
        $sql = "SELECT 
                    idpedido, 
                    fecha, 
                    total, 
                    fk_idcliente, 
                    fk_idsucursal, 
                    fk_idestado,
                    metodo_pago,
                    comentario
                FROM pedidos
                WHERE fk_idsucursal= $idSucursal";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT 
        P.idpedido, 
        P.fecha, 
        P.total, 
        P.fk_idcliente, 
        P.fk_idsucursal, 
        P.fk_idestado,
        P.metodo_pago,
        P.comentario,
        C.nombre AS cliente,
        S.nombre AS sucursal,
        E.nombre AS estado
        FROM pedidos P
        INNER JOIN clientes C ON C.idcliente = P.fk_idcliente
        INNER JOIN sucursales S ON S.idsucursal = P.fk_idsucursal
        INNER JOIN estados E ON E.idestado = P.fk_idestado
        WHERE idpedido = $idPedido
        ";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idcliente = $lstRetorno[0]->cliente;
            $this->fk_idsucursal = $lstRetorno[0]->sucursal;
            $this->fk_idestado = $lstRetorno[0]->estado;
            $this->metodo_pago = $lstRetorno[0]->metodo_pago;
            $this->comentario = $lstRetorno[0]->comentario;
            return $this;
        }
        return null;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE idpedido =?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpedido',
            1 => 'A.fecha',
            2 => 'A.fk_idcliente',
            3 => 'A.fk_idsucursal',
            4 => 'A.fk_idestado',
            5 => 'A.total',
            6 => 'A.metodo_pago'
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.fecha,
                    A.fk_idcliente,
                    A.fk_idsucursal,
                    A.fk_idestado,
                    A.metodo_pago,
                    A.total
                FROM pedidos A
                WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fk_idcliente LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fk_idsucursal LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fk_idestado LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.total LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
        fk_idestado = ?,
        metodo_pago = ?
        WHERE idpedido = ?";
        $affected = DB::update($sql, [
            $this->fk_idestado,
            $this->metodo_pago,
            $this->idpedido
        ]);
    }
}
