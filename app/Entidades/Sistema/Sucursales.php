<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{

    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal', 'telefono', 'nombre', 'direccion', 'fk_idestadosucursal', 'mapa'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
        $this->telefono = $request->input('txtTelefono');
        $this->nombre = $request->input('txtNombre');
        $this->fk_idestadosucursal = $request->input('lstEstado');
        $this->mapa = "";
        $this->curriculum = "";
    }

    public function obtenerTodos()
    {
        $sql = "SELECT 
        idsucursal, 
        telefono, 
        nombre, 
        direccion, 
        fk_idestadosucursal,
        mapa FROM sucursales";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idSucursal)
    {
        $sql = "SELECT 
        idsucursal, 
        telefono, 
        nombre, 
        direccion, 
        fk_idestadosucursal,
        mapa FROM sucursales WHERE idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->fk_idestadosucursal = $lstRetorno[0]->fk_idestadosucursal;
            $this->mapa = $lstRetorno[0]->mapa;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE productos SET
        telefono = '?',
        nombre = '?',
        direccion = '?',
        fk_idestadosucursal = '?',
        mapa = '?'
        WHERE idpostulacion = ?";
        $affected = DB::update($sql, [
            $this->telefono,
            $this->nombre,
            $this->direccion,
            $this->fk_idestadosucursal,
            $this->mapa
        ]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sucursales WHERE idsucursal =?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sucursales(
            telefono,
            nombre,
            direccion,
            fk_idestadosucursal,
            mapa
            ) VALUES (?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->direccion,
            $this->fk_idestadosucursal,
            $this->mapa
        ]);
        return $this->idsucursal = DB::getpdo()->lastInsertId();
    }
}
