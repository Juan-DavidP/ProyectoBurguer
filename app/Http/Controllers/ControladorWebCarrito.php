<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Carrito;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\ProductoPedido;
use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Sucursal;
use Illuminate\Http\Request;
use Session;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;


class ControladorWebCarrito extends Controller
{
      public function index()
      {
            if (Session::get('idcliente') > 0) {
                  $carrito = new Carrito();
                  $aProductos = $carrito->obtenerPorCarrito(Session::get('idcliente'));

                  $sucursal = new Sucursal();
                  $aSucursales = $sucursal->obtenerTodos();
                  if (count($aSucursales) > 0) {
                        $Productos = "";
                        return view("web.carrito", compact('aProductos', 'aSucursales'));
                  } else {
                        return view('web.carrito');
                  }
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

            $pedido = new Pedido();
            $pedido->fecha = date("Y-m-d");
            $pedido->total = $total;
            $pedido->fk_idcliente = $idCliente;
            $pedido->fk_idsucursal = $idSucursal;
            $pedido->fk_idestado = 1; //Pendiente de pago
            $pedido->metodo_pago = $metodoDePago;
            $idPedido = $pedido->insertar();

            if ($metodoDePago == "sucursal") {
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
                  return view('web.pagina-agradecimiento');
            } else if ($metodoDePago == "mercadopago") {
                  $access_token = "TEST-6390311397564415-072818-d4115be4557ceb9d5465f4680d29995a__LB_LA__-70360379";
                  SDK::setClientId(config("payment-methods.mercadopago.client"));
                  SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
                  SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

                  //Armado del producto ‘item’
                  $item = new Item();
                  $item->id = "1234";
                  $item->title = "Burger SRL";
                  $item->category_id = "products";
                  $item->quantity = 1;
                  $item->unit_price = $total;
                  $item->currency_id = "ARS"; //”COP”

                  $preference = new Preference();
                  $preference->items = array($item);

                  $cliente = new Cliente();
                  $cliente->obtenerPorId($idCliente);
                  //Datos del comprador
                  $payer = new Payer();
                  $payer->name = $cliente->nombre;
                  $payer->surname = $cliente->apellido;
                  $payer->email = $cliente->email;
                  $payer->date_created = date('Y-m-d H:m:s');
                  $payer->identification = array(
                        "type" => "DNI",
                        "number" => $cliente->dni,
                  );
                  $preference->payer = $payer;

                  //URL de configuración para indicarle a MP
                  $preference->back_urls = [
                        "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" .  $idPedido,
                        "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" .  $idPedido,
                        "failure" => "http://127.0.0.1:8000/mercado-pago/error/" .  $idPedido,
                  ];

                  $preference->payment_methods = array("installments" => 6);
                  $preference->auto_return = "all";
                  $preference->notification_url = '';
                  $preference->save(); //Ejecuta la transacción
                  print_r("Llamada a MP para el pedido $idPedido");
            }
      }

      public function aprobarCompra($idPedido)
      {
            $pedido = new Pedido();
            $pedido->aprobar($idPedido);
            return view('web.pedido-aprobado');
      }

      public function rechazarCompra($idPedido)
      {
            $pedido = new Pedido();
            $pedido->rechazar($idPedido);
            return view('web.pedido-rechazado');
      }

      public function eliminarProductoDelCarrito($idCarrito)
      {
            $carrito = new Carrito();

            $carrito->eliminarProductoCarrito($idCarrito);
            return redirect("/carrito");
      }
}
