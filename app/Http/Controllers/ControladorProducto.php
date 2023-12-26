<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Categoria;

require app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo producto";
        $producto = new Producto();
        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        return view('sistema.producto-nuevo', compact('titulo', 'producto', 'aCategorias'));
    }

    public function index()
    {
        $titulo = "Listado de productos";
        return view('sistema.producto-listar', compact('titulo'));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);

            if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
                $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                $nombre = date("Ymdhmsi") . ".$extension";
                $archivo = $_FILES["imagen"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
                $entidad->imagen = $nombre;
            }

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";

                $producto = new Producto();
                $producto->obtenerPorId($entidad->idproducto);
                $categoria = new Categoria();
                $aCategorias = $categoria->obtenerTodos();

                return view('sistema.producto-nuevo', compact('msg', 'producto', 'titulo', 'aCategorias')) . '?id=' . $entidad->idproducto;
            } else {
                if ($_POST["id"] > 0) {
                    $productAnt = new Producto();
                    $productAnt->obtenerPorId($entidad->idproducto);

                    if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$productAnt->imagen");
                    } else {
                        $entidad->imagen = $productAnt->imagen;
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
                $_POST["id"] = $entidad->idproducto;
                return view('sistema.producto-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aProductos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/producto/' . $aProductos[$i]->idproducto . '" class="btn btn-secondary">Editar</a>';
            $row[] = $aProductos[$i]->nombre;
            $row[] = $aProductos[$i]->cantidad;
            $row[] = '$' . number_format($aProductos[$i]->precio, 2, ",", ".");
            $row[] = '<img src="/files/' . $aProductos[$i]->imagen . '" alt="Imagen del producto" class="img-thumbnail">';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
            "data" => $data
        );
        return json_encode($json_data);
    }

    public function editar($id){
        $titulo = "Edición de producto";
        $producto = new Producto();
        $producto->obtenerPorId($id);


        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        return view('sistema.producto-nuevo', compact('titulo', 'producto' ,'aCategorias'));
    }
    
}
