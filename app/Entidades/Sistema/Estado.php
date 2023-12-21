<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class EstadoSucursal extends Model
{
      protected $table = 'estados';
      public $timestamps = false;

      protected $fillable = ['idestado', 'nombre'];

      protected $hidden = [];

      public function obtenerTodos()
      {
            $sql = "SELECT * FROM estados";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      
}