<?php

namespace App\Http\Controllers;
use App\Entidades\Sistema\Postulacion;

require app_path() . '/start/constants.php';


class ControladorWebPostulacion extends Controller
{
    public function index()
    {
            return view("web.nosotros");
    }

    public function guardarPostulacion()
    {
        try {
            
            $entidad = new Postulacion();

            $entidad->nombre = $_POST["txtNombre"] ?? '';
            $entidad->apellido = $_POST["txtApellido"] ?? '';
            $entidad->telefono = $_POST["txtTelefono"] ?? '';
            $entidad->direccion = $_POST["txtDireccion"] ?? '';
            $entidad->correo = $_POST["txtCorreo"] ?? '';

            if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === UPLOAD_ERR_OK) {
                $extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
                $nombre = date("Ymdhmsi") . ".$extension";
                $archivo = $_FILES["cv"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre");
                $entidad->curriculum = $nombre;
            }

            // Validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
                return view('web.nosotros', compact('msg'));
            }

            // Guardar nueva postulación
            $entidad->insertar();

            $msg["ESTADO"] = MSG_SUCCESS;
            $msg["MSG"] = "Gracias, pronto estará recibiendo noticias nuestras.";

            return view('web.postulacion-gracias', compact('msg'));
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
            
        }
    }
}