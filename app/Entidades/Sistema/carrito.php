<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
      protected $table = 'carritos_productos';
      public $timestamps = false;

      protected $fillable = ['idcarritoproducto', 'fk_idcliente', 'fk_idproducto', 'cantidad'];

      protected $hidden = [];

      public function obtenerPorCarrito($idcliente)
      {
            $sql = " SELECT 
            CP.idcarritoproducto,
            CP.cantidad,
            P.nombre,
            P.imagen,
            P.precio,
            CP.fk_idproducto,
            P.descripcion 
            from carritos_productos CP
            INNER JOIN clientes CL ON CP.fk_idcliente = CL.idcliente
            INNER JOIN productos P ON CP.fk_idproducto = P.idproducto 
            WHERE CL.idcliente = $idcliente
           ;";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;

            if (count($lstRetorno) > 0) {
                  $this->idcarritoproducto = $lstRetorno[0]->idcarritoproducto;
                  $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
                  $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
                  $this->cantidad = $lstRetorno[0]->cantidad;
                  return $this;
            }
            return array();
      }

    public function eliminarPorCliente($idCliente)
    {
        $sql = "DELETE FROM carritos_productos WHERE fk_idcliente=?";
        $affected = DB::delete($sql, [$idCliente]);
    }

       public function insertar()
    {
        $sql = "INSERT INTO carritos_productos (
                 fk_idcliente,
                 fk_idproducto,
                 cantidad
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente,
            $this->fk_idproducto,
            $this->cantidad
        ]);
        return $this->idcarritoproducto = DB::getPdo()->lastInsertId();
    }

}
