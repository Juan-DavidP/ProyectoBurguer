<?php

namespace App\Http\Controllers;

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva postulacion";
        return view('sistema-postulacion-nuevo', compact('titulo'));
    }

     public function index(){
        $titulo = "Listado de postulaciones";
        return view('sistema.postulacion-listar', compact('titulo'));
    }
}
