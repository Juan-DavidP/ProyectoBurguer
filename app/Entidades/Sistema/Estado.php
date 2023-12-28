<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
      protected $table = 'estados';
      public $timestamps = false;

      protected $fillable = ['idestado', 'nombre'];

      protected $hidden = [];

      public function obtenerTodos()
      {
            $sql = "SELECT idestado, nombre FROM estados";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      
}