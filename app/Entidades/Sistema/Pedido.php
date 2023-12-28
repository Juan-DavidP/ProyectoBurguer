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
    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT 
                    idpedido, 
                    fecha, 
                    total, 
                    fk_idcliente, 
                    fk_idsucursal, 
                    fk_idestado,
                    metodo_pago 
                FROM pedidos
                WHERE fk_idcliente=$idCliente";
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
        $sql = "DELETE FROM pedidos WHERE idpedido =?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }
    /*
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
    public function guardar()
    {
        $sql = "UPDATE productos SET
        nombre = '?',
        cantidad = ?,
        precio = ?,
        descripcion = '?',
        imagen = '?',
        fk_idcategoria = ?
        WHERE idproducto = ?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->descripcion,
            $this->imagen,
            $this->fk_idcategoria
        ]);
    }*/

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
}
