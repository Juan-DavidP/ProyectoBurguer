<?php

namespace App\Http\Controllers;

class ControladorCliente extends Controller
{

    public function nuevo()
    {
        $titulo = "Nuevo cliente";
        return view('sistema.cliente-nuevo', compact('titulo'));
    }

    public function index(){
        $titulo = "Listado de clientes";
        return view('sistema.cliente-listar', compact('titulo'));
    }
}
