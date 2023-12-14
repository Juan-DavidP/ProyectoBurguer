<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
      protected $table = 'categorias';
      public $timestamps = false;

      protected $fillable = [
            'idcategoria', 'nombre',
      ];

      protected $hidden = [];

      public function cargarDesdeRequest($request)
      {
            $this->idcategoria = $request->input('id') != "0" ? $request->input('id') : $this->idcategoria;
            $this->nombre = $request->input('txtNombre');
      }

      public function obtenerTodos()
      {
            $sql = "SELECT
                  idcategoria,
                  nombre,
                FROM categorias ORDER BY nombre";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      public function obtenerPorId($idcategoria)
      {
            $sql = "SELECT
                  idcliente,
                  nombre,
                FROM categorias WHERE idcategoria = $idcategoria";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idcategoria = $lstRetorno[0]->idcategoria;
                  $this->nombre = $lstRetorno[0]->nombre;
                  return $this;
            }
            return null;
      }

      public function guardar()
      {
            $sql = "UPDATE clientes SET
            nombre='?',
            apellido='?',
            correo='?',
            telefono='?',
            dni='?',
            clave='?'
            WHERE idcliente=?";
            $affected = DB::update($sql, [
                  $this->nombre,
                  $this->apellido,
                  $this->correo,
                  $this->telefono,
                  $this->dni,
                  $this->clave,
                  $this->idcliente
            ]);
      }

      public function eliminar()
      {
            $sql = "DELETE FROM categorias WHERE
            idcategoria=?";
            $affected = DB::delete($sql, [$this->idcategoria]);
      }

      public function insertar()
      {
            $sql = "INSERT INTO categorias (
                  nombre
            ) VALUES (?);";
            $result = DB::insert($sql, [
                  $this->nombre
            ]);
            return $this->idcategoria = DB::getPdo()->lastInsertId();
      }
}
