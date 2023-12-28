<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
      protected $table = 'productos_pedidos';
      public $timestamps = false;

      protected $fillable = [
            'idproductopedido', 'fk_idproducto', 'fk_idpedido', 'precio_unitario', 'cantidad', 'total'
      ];

      protected $hidden = [];

      public function cargarDesdeRequest($request)
      {
            $this->idproductopedido = $request->input('id') != "0" ? $request->input('id') : $this->idproductopedido;
            $this->fk_idproducto = $request->input('lstProducto');
            $this->fk_idpedido = $request->input('lstPedido');
            $this->precio_unitario = $request->input('txtPrecioUnitario');
            $this->cantidad = $request->input('txtCantidad');
            $this->total = $request->input('txtTotal');
      }

      public function obtenerTodos()
      {
            $sql = "SELECT 
        idproductopedido, 
        fk_idproducto, 
        fk_idpedido, 
        precio_unitario, 
        cantidad, 
        total FROM productos_pedidos";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      public function obtenerPorId($idproductopedido)
      {
            $sql = "SELECT 
        idproductopedido, 
        fk_idproducto, 
        fk_idpedido, 
        precio_unitario, 
        cantidad, 
        total FROM productos_pedidos WHERE idproductopedido = $idproductopedido";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idproductopedido = $lstRetorno[0]->idproductopedido;
                  $this->fk_idproducto = $lstRetorno[0]->producto;
                  $this->fk_idpedido = $lstRetorno[0]->pedido;
                  $this->precio_unitario = $lstRetorno[0]->precio_unitario;
                  $this->cantidad = $lstRetorno[0]->cantidad;
                  $this->total = $lstRetorno[0]->total;
                  return $this;
            }
            return null;
      }

      public function guardar()
      {
            $sql = "UPDATE productos_pedidos SET
        fk_idproducto = ?,
        fk_idpedido = ?,
        precio_unitario = ?,
        cantidad = ?,
        total = ?
        WHERE idproductopedido = ?";
            $affected = DB::update($sql, [
                  $this->fk_idproducto,
                  $this->fk_idpedido,
                  $this->precio_unitario,
                  $this->cantidad,
                  $this->total,
                  $this->idproductopedido
            ]);
      }

      public function eliminar()
      {
            $sql = "DELETE FROM productos_pedidos WHERE idproductopedido =?";
            $affected = DB::delete($sql, [$this->idproductopedido]);
      }

      public function insertar()
      {
            $sql = "INSERT INTO productos_pedidos(
            fk_idproducto,
            fk_idpedido,
            precio_unitario,
            cantidad,
            total
            ) VALUES (?, ?, ?, ?, ?)";
            $result = DB::insert($sql, [
                  $this->fk_idproducto,
                  $this->fk_idpedido,
                  $this->precio_unitario,
                  $this->cantidad,
                  $this->total
            ]);
            return $this->idproductopedido = DB::getpdo()->lastInsertId();
      }

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'A.idproductopedido',
                  1 => 'A.fk_idproducto',
                  2 => 'A.fk_idpedido',
                  3 => 'A.precio_unitario',
                  4 => 'A.cantidad',
                  5 => 'A.total',
            );
            $sql = "SELECT DISTINCT
                    A.idproductopedido,
                    A.fk_idproducto,
                    A.fk_idpedido,
                    A.precio_unitario,
                    A.cantidad,
                    A.total
                FROM productos_pedidos A
                WHERE 1=1
                ";

            //Realiza el filtrado
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( A.fk_idproducto LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.fk_idpedido LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.precio_unitario LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.cantidad LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.total LIKE '%" . $request['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);

            return $lstRetorno;
      }
}
