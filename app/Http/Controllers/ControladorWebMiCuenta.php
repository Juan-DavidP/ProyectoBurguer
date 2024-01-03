<?php
namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        if(Session::get("idcliente") && Session::get("idcliente") > 0){
            $idCliente = Session::get("idcliente");
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
            return view("web.mi-cuenta", compact("cliente"));
        } else {
            return redirect("/login");
        }
    }

    public function guardar(){
        
    }
}
