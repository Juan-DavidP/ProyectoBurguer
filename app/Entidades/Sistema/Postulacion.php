<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'telefono', 'direccion', 'correo',
        'curriculum'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idpostulacion = $request->input('id') != "0" ? $request->input('id') : $this->idpostulacion;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->telefono = $request->input('txtTelefono');
        $this->direccion = $request->input('txtDireccion');
        $this->correo = $request->input('txtCorreo');
        $this->curriculum = "";
    }

    public function obtenerTodos()
    {
        $sql = "SELECT 
        idpostulacion, 
        nombre, 
        apellido, 
        telefono, 
        direccion, 
        correo,
        curriculum FROM postulaciones";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPostulacion)
    {
        $sql = "SELECT 
        idpostulacion, 
        nombre, 
        apellido, 
        telefono, 
        direccion, 
        correo,
        curriculum FROM postulaciones WHERE idpostulacion = $idPostulacion";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->correo = $lstRetorno[0]->correo;
            $this->curriculum = $lstRetorno[0]->curriculum;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE postulaciones SET
        nombre = '?',
        apellido = '?',
        telefono = '?',
        direccion = '?',
        correo = '?',
        curriculum = '?'
        WHERE idpostulacion = ?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->direccion,
            $this->correo,
            $this->curriculum
        ]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM postulaciones WHERE idpostulacion =?";
        $affected = DB::delete($sql, [$this->idpostulacion]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO postulaciones(
            nombre,
            apellido,
            telefono,
            direccion,
            correo,
            curriculum
            ) VALUES (?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->direccion,
            $this->correo,
            $this->curriculum
        ]);
        return $this->idpostulacion = DB::getpdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpostulacion',
            1 => 'A.nombre',
            2 => 'A.apellido',
            3 => 'A.telefono',
            4 => 'A.direccion',
            5 => 'A.correo',
        );
        $sql = "SELECT DISTINCT
                    A.idpostulacion,
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.direccion,
                    A.correo
                FROM postulaciones A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

    }
}
