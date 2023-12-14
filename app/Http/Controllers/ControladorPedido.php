<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Pedido;
require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
      public function nuevo()
      {
            $titulo = "Nuevo pedido";
            return view('sistema.pedido-nuevo', compact('titulo'));
      }

      public function index()
      {
            $titulo = "Listado de pedidos";
            return view('sistema.pedido-listar', compact('titulo'));
      }

      
}