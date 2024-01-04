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
        if ($request->input('txtClave') ==  $request->input('txtRepetirClave')) {
            echo "iguales";
            exit;
            $cliente = new Cliente();
            $cliente->nombre = $request->input('txtNombre');
            $cliente->apellido = $request->input('txtApellido');
            $cliente->correo = $request->input('txtCorreo');
            $cliente->clave =  password_hash($request->input('txtClave'), PASSWORD_DEFAULT);
            $cliente->telefono = $request->input('txtTelefono');
            $cliente->dni = $request->input('txtDni');
            $cliente->insertar();
            if ($cliente->idcliente != "") {
                return redirect("/login");
            }
        } else {
            echo "diferentes";
            exit;
            $msg = "Las contraseñas no coinciden";
        }
    }
}
