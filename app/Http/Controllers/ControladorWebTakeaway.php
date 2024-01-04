<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Categoria;
use App\Entidades\Sistema\Cliente;

use Session;

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

    public function agregarCarrito(Request $request){
        $idCliente = Session::get("idcliente");
    
        
        if ($idCliente && $idCliente > 0) {
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
    
            
            $productoId = 1;
            $cliente->agregarAlCarrito($productoId);
    
            return view("", compact("cliente"));
        } else {
            
            return redirect("/login");
        }
    }
    
    
}

