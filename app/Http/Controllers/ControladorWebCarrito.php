<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Carrito;

class ControladorWebCarrito extends Controller
{
      public function index()
      {
            $carrito = new Carrito();
            $aProductos = $carrito->obtenerPorCarrito();
            return view("web.carrito", compact('aProductos'));
      }
}
