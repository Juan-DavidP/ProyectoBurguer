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
        $cliente->nombre = $request->input('txtNombre');
        $cliente->apellido = $request->input('txtApellido');
        $cliente->correo = $request->input('txtCorreo');
        $cliente->clave = $request->input('txtClave');
        $cliente->telefono = $request->input('txtTelefono');
        $cliente->dni = $request->input('txtDni');
        $cliente->insertar();
        if($cliente->idcliente != ""){
            return redirect("/login");
        }
    }
}
