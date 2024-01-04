<?php

namespace App\Http\Controllers;


use App\Entidades\Sistema\Pedido;

class ControladorWebPedido extends Controller
{
    public function index()
    {
        // Crea una instancia de la clase Pedido
        $pedido = new Pedido();

        // Obtén todos los pedidos
        $aPedidos = $pedido->obtenerTodos();

        // Pasa las variables a la vista
        return redirect("/mi-cuenta");
    }
}
