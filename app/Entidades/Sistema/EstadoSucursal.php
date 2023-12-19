<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class EstadoSucursal extends Model
{
      protected $table = 'estados_sucursales';
      public $timestamps = false;

      protected $fillable = ['idestadosucursal', 'nombre'];

      protected $hidden = [];

      public function obtenerTodos()
      {
            $sql = "SELECT * FROM estados_sucursales";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
}
