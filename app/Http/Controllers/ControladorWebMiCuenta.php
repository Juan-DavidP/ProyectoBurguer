<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entidades\Sistema\Cliente;
use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        if (Session::get("idcliente") && Session::get("idcliente") > 0) {
            $idCliente = Session::get("idcliente");
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
            return view("web.mi-cuenta", compact("cliente"));
        } else {
            return redirect("/login");
        }
    }

    public function guardar(Request $request)
    {
        $nombre = $request->input("txtNombre");
        
        if (Session::get("idcliente") && Session::get("idcliente") > 0) {
            $idCliente = Session::get("idcliente");

            // Obtener el cliente existente
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
            $cliente->nombre = $nombre;
            $cliente->guardar();

            return view("web.mi-cuenta", compact("cliente"));
        } else {
            return redirect("/login");
        }
    }
}
