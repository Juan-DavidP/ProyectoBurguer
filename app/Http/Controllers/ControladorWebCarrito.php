<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Carrito;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\ProductoPedido;
use App\Entidades\Sistema\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        if (Session::get('idcliente') > 0) {
            $carrito = new Carrito();
            $aProductos = $carrito->obtenerPorCarrito(Session::get('idcliente'));

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();

            return view("web.carrito", compact('aProductos', 'aSucursales'));
        } else {
            return redirect('/login');
        }
    }

    public function confirmarCompra(Request $request)
    {
        $idCliente = Session::get("idcliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCarrito($idCliente);
        $idSucursal = $request->input("lstSucursal");
        $metodoDePago = $request->input("lstMetodoDePago");

        $total = 0;
        foreach ($aCarritos as $item) {
            $total += $item->precio * $item->cantidad;
        }

        if ($metodoDePago == "sucursal") {
            $pedido = new Pedido();
            $pedido->fecha = date("Y-m-d");
            $pedido->total = $total;
            $pedido->fk_idcliente = $idCliente;
            $pedido->fk_idsucursal = $idSucursal;
            $pedido->fk_idestado = 1; //Pendiente de pago
            $pedido->metodo_pago = "Pago en sucursal";
            $idPedido = $pedido->insertar();

            foreach ($aCarritos as $item) {
                $productoPedido = new ProductoPedido();
                $productoPedido->fk_idproducto = $item->fk_idproducto;
                $productoPedido->fk_idpedido = $idPedido;
                $productoPedido->precio_unitario = $item->precio;
                $productoPedido->cantidad = $item->cantidad;
                $productoPedido->total = $item->precio * $item->cantidad;
                $productoPedido->insertar();
            }

            //Vaciamos el carrito
            $carrito->eliminarPorCliente($idCliente);
            return "Gracias";

        } else if ($metodoDePago == "mercadopago") {

        }

    }
}
