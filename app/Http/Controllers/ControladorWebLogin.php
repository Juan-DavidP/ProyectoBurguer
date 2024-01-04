<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Session;
use Illuminate\Http\Request;


class ControladorWebLogin extends Controller
{
    public function index()
    {
        return view("web.login");
    }

    public function ingresar(Request $request)
    {
        $correo = $request->input("txtCorreo");
        $clave = $request->input("txtClave");
        $cliente = new Cliente();

        if ($cliente->obtenerPorCorreo($correo)) {
            if (password_verify($clave, $cliente->clave)) {
                Session::put("correo", $cliente->correo);
                return redirect("/mi-cuenta");
            } else {
                $msg = "Credenciales incorrectas";
            }
        } else {
            $msg = "Credenciales incorrectas";
        }
    }
}
