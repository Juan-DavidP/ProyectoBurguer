<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Categoria;
require app_path() . '/start/constants.php';

class ControladorCategoria extends COntroller
{
      public function nuevo()
      {
            $titulo = "Nueva categoría";
            return view('sistema.categoria-nuevo', compact('titulo'));
      }

      public function index()
      {
            $titulo = "Listado de categorías";
            return view('sistema.categoria-listar', compact('titulo'));
      }

      public function guardar(Request $request){
            try {
               //Define la entidad servicio
               $titulo = "Modificar cliente";
               $entidad = new Categoria();
               $entidad->cargarDesdeRequest($request);
   
               //validaciones
               if ($entidad->nombre == "") {
                   $msg["ESTADO"] = MSG_ERROR;
                   $msg["MSG"] = "Complete todos los datos";
   
                   $categoria = new Categoria();
                   $categoria->obtenerPorId($entidad->idcategoria);
                   return view('sistema.categoria-nuevo', compact('msg', 'categoria', 'titulo')) . '?id=' . $entidad->idcategoria;
   
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
                
                   $_POST["id"] = $entidad->idcategoria;
                   $titulo = "Listado de categorias";
                   return view('sistema.categoria-listar', compact('titulo', 'msg'));
               }
           } catch (Exception $e) {
               $msg["ESTADO"] = MSG_ERROR;
               $msg["MSG"] = ERRORINSERT;
           }
       }
}