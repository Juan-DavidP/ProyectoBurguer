<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Carrito;
use Session;

class ControladorWebCarrito extends Controller
{
      public function index()
      {
            $carrito = new Carrito();
            $aProductos = $carrito->obtenerPorCarrito(Session::get('idcliente'));
            return view("web.carrito", compact('aProductos'));
      }
}
