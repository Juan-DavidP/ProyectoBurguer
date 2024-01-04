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
        $clave = trim($request->input("txtClave"));

        $cliente = new Cliente();
        if ($cliente->obtenerPorCorreo($correo)) {
            if (password_verify($clave, $cliente->clave)) {
                Session::put("idcliente", $cliente->idcliente);
                return redirect("/mi-cuenta");
            } else {
                $msg = "Credenciales incorrectas";
            }
        } else {
            $msg = "Credenciales incorrectas";
        }
        return view('web.login',compact("msg"));
    }
}
