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
        $this->direccion = $request->input('txtDireccion');
        $this->fk_idestadosucursal = $request->input('lstEstado');
        $this->mapa = $request->input('txtUbicacion');
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
            ) VALUES (?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->nombre,
            $this->direccion,
            $this->fk_idestadosucursal,
            $this->mapa
        ]);
        return $this->idsucursal = DB::getpdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idsucursal',
            1 => 'A.nombre',
            2 => 'A.telefono',
            3 => 'A.direccion',
            4 => 'A.fk_idestadosucursal',
            5 => 'A.mapa'
        );
        $sql = "SELECT DISTINCT
                    A.idsucursal,
                    A.nombre,
                    A.telefono,
                    A.direccion,
                    A.fk_idestadosucursal,
                    A.mapa
                FROM sucursales A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fk_idestadosucursal LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.mapa LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}
