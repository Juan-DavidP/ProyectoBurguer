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

      public function obtenerPorCarrito($idcliente)
      {
            $sql = " SELECT 
            C.idcarrito,
            CP.cantidad,
            Cl.nombre,
            P.imagen,
            P.precio,
            P.descripcion 
            from carritos C
            INNER JOIN carritos_productos CP ON  C.idcarrito  = CP.fk_idcarrito
            INNER JOIN clientes CL ON C.fk_idcliente = CL.idcliente
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
            return null;
      }
}
