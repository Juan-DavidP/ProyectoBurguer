<?php

namespace App\Http\Controllers;

class ControladorProducto extends COntroller
{
      public function nuevo()
      {
            $titulo = "Nuevo producto";
            return view('sistema.producto-nuevo', compact('titulo'));
      }
}
