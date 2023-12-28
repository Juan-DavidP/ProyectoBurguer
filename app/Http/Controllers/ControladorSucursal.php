<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\EstadoSucursal;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    public function nuevo()
    {
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALALTA")) {
                $codigo = "SUCURSALALTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $titulo = "Nueva sucursal";
                $sucursal = new Sucursal();

                $estado = new EstadoSucursal();
                $aEstados = $estado->obtenerTodos();
                return view('sistema.sucursal-nuevo', compact('titulo', 'sucursal', 'aEstados'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function index()
    {
        $titulo = "Listado de sucursales";
        return view('sistema.sucursal-listar', compact('titulo'));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Sucursal";
            $entidad = new Sucursal();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";

                $sucursal = new Sucursal();
                $sucursal->obtenerPorId($entidad->idsucursal);

                $estado = new EstadoSucursal();
                $aEstados = $estado->obtenerTodos();

                return view('sistema.sucursal-nuevo', compact('msg', 'sucursal', 'titulo', 'aEstados')) . '?id=' . $entidad->idsucursal;
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }

                $_POST["id"] = $entidad->idsucursal;
                $titulo = "Listado de sucursales";
                return view('sistema.sucursal-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sucursal/' . $aSucursales[$i]->idsucursal . '" class="btn btn-secondary">Editar</a>';
            $row[] = $aSucursales[$i]->nombre;
            $row[] = $aSucursales[$i]->telefono;
            $row[] = $aSucursales[$i]->direccion;
            $row[] = $aSucursales[$i]->estado_sucursal;
            $row[] = $aSucursales[$i]->mapa;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Edición de sucursal";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALEDITAR")) {
                $codigo = "SUCURSALEDITAR";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $sucursal = new Sucursal();
                $sucursal->obtenerPorId($id);

                $estado = new EstadoSucursal();
                $aEstados = $estado->obtenerTodos();

                return view('sistema.sucursal-nuevo', compact('titulo', 'sucursal', 'aEstados'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        if (Usuario::autenticado() == true && Patente::autorizarOperacion("CLIENTEELIMINAR")) {
            $id = $request->input("id");
            //Si no tiene ventas asociadas, elimina la sucursal
            $pedido = new Pedido();
            $aPedidos = $pedido->obtenerPorSucursal($id);

            if (count($aPedidos) == 0) {
                $sucursal = new Sucursal();
                $sucursal->idsucursal = $id;
                $sucursal->eliminar();
                $data["err"] = "OK";
            } else {
                $data["err"] = "No se puede eliminar una sucursal con pedidos asociados.";
            }
            return json_encode($data);
        }
    }
}
