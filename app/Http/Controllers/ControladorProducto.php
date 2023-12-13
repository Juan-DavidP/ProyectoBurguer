<?php

namespace App\Http\Controllers;

class ControladorProducto extends COntroller
{
      public function nuevo()
      {
            $titulo = "Nuevo producto";
            return view('sistema.producto-nuevo', compact('titulo'));
      }

      public function index()
      {
            $titulo = "Listado de productos";
            return view('sistema.producto-listar', compact('titulo'));
      }
}
