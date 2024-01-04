<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
      protected $table = 'carrito';
      public $timestamps = false;

      protected $fillable = ['idcarritoproducto', 'fk_idcarrito', 'fk_idproducto', 'cantidad'];

      protected $hidden = [];

      public function obtenerPorCarrito()
      {
            $sql = "SELECT 
            C.idcarritoproducto,
            C.fk_idcarrito,
            C.fk_idproducto,
            C.cantidad ,
            P.idproducto,
            P.nombre,
            P.descripcion,
            P.imagen,
            P.precio
            FROM carritos_productos C
            INNER JOIN productos p ON C.fk_idproducto = P.idproducto 
            WHERE fk_idcarrito= 1;";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;

            if (count($lstRetorno) > 0) {
                  $this->idcarritoproducto = $lstRetorno[0]->idcarritoproducto;
                  $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
                  $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
                  $this->cantidad = $lstRetorno[0]->cantidad;
                  return $this;
            }
            return null;
      }
}
