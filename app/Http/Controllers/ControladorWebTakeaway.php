<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Categoria;

class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        // Obtén las categorías desde la base de datos o como lo tengas implementado
        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        // Obtén los productos como lo haces actualmente
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        // Pasa las variables a la vista
        return view("web.takeaway", compact('aCategorias', 'aProductos'));
    }
}

