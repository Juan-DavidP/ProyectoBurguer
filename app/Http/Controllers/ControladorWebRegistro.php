<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Illuminate\Http\Request;
use Session;
use DB;

class ControladorWebRegistro extends Controller
{
      public function index()
      {
            return view("web.registro");
      }

      
    public function registrar(Request $request)
    {
        $cliente = new Cliente();

        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $correo = $request->input('txtCorreo');
        $clave = $request->input('txtClave');
        $telefono = $request->input('txtTelefono');
        $dni = $request->input('txtDni');

        $sql = "INSERT INTO clientes (
                  nombre,
                  apellido,
                  correo,
                  telefono,
                  dni,
                  clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $dni,
            $clave,
        ]);
        // return $this->idcliente = DB::getPdo()->lastInsertId();
    }
}
