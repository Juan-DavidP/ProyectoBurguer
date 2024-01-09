<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Pedido;
use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        if (Session::get("idcliente") && Session::get("idcliente") > 0) {
            $idCliente = Session::get("idcliente");
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);

            // Crea una instancia de la clase Pedido
            $pedido = new Pedido();
            // Obtén todos los pedidos
            $aPedidos = $pedido->obtenerTodos();

            return view("web.mi-cuenta", compact("cliente", "aPedidos"));
        } else {
            return redirect("/login");
        }
    }

    public function guardar(Request $request)
    {
        $nombre = $request->input("txtNombre");
        $apellido = $request->input("txtApellido");
        $telefono = $request->input("txtTelefono");
        $correo = $request->input("txtCorreo");
        
        if (Session::get("idcliente") && Session::get("idcliente") > 0) {
            $idCliente = Session::get("idcliente");

            // Obtener el cliente existente
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
            $cliente->nombre = $nombre;
            $cliente->apellido = $apellido;
            $cliente->telefono = $telefono;
            $cliente->correo = $correo;

            $cliente->guardar();

              $pedido = new Pedido();
            // Obtén todos los pedidos
            $aPedidos = $pedido->obtenerTodos();

            return view("web.mi-cuenta", compact("cliente", "aPedidos"));
        } else {
            return redirect("/login");
        }
    }
}
