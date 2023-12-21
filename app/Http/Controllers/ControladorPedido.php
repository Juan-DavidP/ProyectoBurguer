<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Estado;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
      
      public function index()
      {
            $titulo = "Listado de pedidos";
            return view('sistema.pedido-listar', compact('titulo'));
      }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/pedidos/' . $aPedidos[$i]->idpedido . '" class="btn btn-secondary">Editar</a>';
            $row[] = $aPedidos[$i]->fecha;
            $row[] = $aPedidos[$i]->fk_idcliente;
            $row[] = $aPedidos[$i]->metodo_pago;
            $row[] = $aPedidos[$i]->fk_idsucursal;
            $row[] = $aPedidos[$i]->fk_idestado;
            $row[] = $aPedidos[$i]->total;
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

      
}