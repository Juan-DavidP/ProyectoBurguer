<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ControladorCliente extends Controller
{

    public function nuevo()
    {
        $titulo = "Nuevo cliente";
        return view('sistema.cliente-nuevo', compact('titulo'));
    }

    public function index(){
        $titulo = "Listado de clientes";
        return view('sistema.cliente-listar', compact('titulo'));
    }

    public function guardar(Request $request){
         try {
            //Define la entidad servicio
            $titulo = "Modificar cliente";
            $entidad = new Cliente();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
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
             
                $_POST["id"] = $entidad->idmenu;
                return view('sistema.menu-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idmenu;
        $menu = new Menu();
        $menu->obtenerPorId($id);

        return view('sistema.menu-nuevo', compact('msg', 'menu', 'titulo')) . '?id=' . $menu->idmenu;

    }
}
