<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Session;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        return view("web.recuperar-contraseña");
    }

    public function recuperarClave()
    {
        // $cliente = new Cliente();
        return redirect("/clave-nueva");
    }
}
