<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Estado;
use App\Entidades\Sistema\Producto;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
    public function index()
    {
        $titulo = "Listado de pedidos";
        return view('sistema.pedido-listar', compact('titulo'));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $entidad = new Pedido();
            $entidad->cargarDesdeRequest($request);
            if ($_POST["id"] > 0) {
                //Es actualizacion
                $entidad->guardar();
                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            }

            $_POST["id"] = $entidad->idpedido;
            $titulo = "Listado de pedidos";
            return view('sistema.pedido-listar', compact('titulo', 'msg'));
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
    }


    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $estado = new Estado();
        $aEstados = $estado->obtenerTodos();

        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $data = array();
        $cont = 0;
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/pedidos/ver-pedido/' . $aPedidos[$i]->idpedido . '" class="btn btn-secondary">Ver pedido</a>';
            $row[] = $aPedidos[$i]->fecha;
            $row[] = '$' . number_format($aPedidos[$i]->total, 2, ",", ".");
            // $row[] = $aPedidos[$i]->fk_idcliente;
            foreach ($aClientes as $cliente) {
                if ($aPedidos[$i]->fk_idcliente == $cliente->idcliente) {
                    $row[] = $cliente->nombre . " " . $cliente->apellido;
                }
            }
            // $row[] = $aPedidos[$i]->fk_idsucursal;
            foreach ($aSucursales as $sucursal) {
                if ($aPedidos[$i]->fk_idsucursal == $sucursal->idsucursal) {
                    $row[] = $sucursal->nombre;
                }
            }
            // $row[] = $aPedidos[$i]->fk_idestado;
            foreach ($aEstados as $estado) {
                if ($aPedidos[$i]->fk_idestado == $estado->idestado) {
                    $row[] = $estado->nombre;
                }
            }
            $row[] = $aPedidos[$i]->metodo_pago;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Edicción de pedido";
        $metodos_pago = ["Efectivo", "Transferencia", "Bono"];
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);

        $estado = new Estado();
        $aEstados = $estado->obtenerTodos();
        
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        return view('sistema.ver-pedido', compact('titulo', 'pedido', 'aEstados', 'metodos_pago', 'aProductos'));
    }
}
