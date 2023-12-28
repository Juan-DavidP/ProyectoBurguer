<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Postulacion;

require app_path() . '/start/constants.php';

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva postulacion";
        $postulacion = new Postulacion();
        return view('sistema.postulacion-nuevo', compact('titulo', 'postulacion'));
    }

    public function index()
    {
        $titulo = "Listado de postulaciones";
        return view('sistema.postulacion-listar', compact('titulo'));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar producto";
            $entidad = new Postulacion();
            $entidad->cargarDesdeRequest($request);

            if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === UPLOAD_ERR_OK) { //Se adjunta el cv
                $extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
                $nombre = date("Ymdhmsi") . ".$extension";
                $archivo = $_FILES["cv"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
                $entidad->curriculum = $nombre;
            }

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";

                $postulacion = new Postulacion();
                $postulacion->obtenerPorId($entidad->idpostulacion);

                return view('sistema.postulacion-nuevo', compact('msg', 'producto', 'titulo')) . '?id=' . $entidad->idpostulacion;
            } else {
                if ($_POST["id"] > 0) {
                    $postulacionAnt = new Postulacion();
                    $postulacionAnt->obtenerPorId($entidad->idpostulacion);

                    if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
                        //Eliminar cv anterior
                        @unlink(env('APP_PATH') . "/public/files/$postulacionAnt->curriculum");
                    } else {
                        $entidad->curriculum = $postulacionAnt->curriculum;
                    }

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
                $_POST["id"] = $entidad->idpostulacion;
                return view('sistema.postulacion-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Postulacion();
        $aPostulaciones = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPostulaciones) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/postulacion/' . $aPostulaciones[$i]->idpostulacion . '" class="btn btn-secondary">Editar</a>';
            $row[] = $aPostulaciones[$i]->nombre;
            $row[] = $aPostulaciones[$i]->apellido;
            $row[] = $aPostulaciones[$i]->telefono;
            $row[] = $aPostulaciones[$i]->direccion;
            $row[] = $aPostulaciones[$i]->correo;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPostulaciones), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPostulaciones), //cantidad total de registros en la paginacion
            "data" => $data
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Edición de postulación";
        $postulacion = new Postulacion();
        $postulacion->obtenerPorId($id);
        return view('sistema.postulacion-nuevo', compact('titulo', 'postulacion'));
    }

    public function eliminar(Request $request)
    {
        $id = $request->input("id");
        $postulacion = new Postulacion();
        $postulacion->idpostulacion = $id;
        $postulacion->eliminar();
        $data["err"] = "OK";
        return json_encode($data);
    }
}
