<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        return view('web.recuperar-contraseña');
    }

    public function recuperarClave(Request $request)
    {
        $cliente = new Cliente();
        $correo = $request->input('txtCorreo');
        $verficiarCorreo = $cliente->verificarExistenciaMail($correo);
        if ($verficiarCorreo > 0) {
            // echo "prueba correcta";
            // echo str_random(12);
            // echo str_shuffle("hola");
            // echo rand(1, 2000);
            $claveNueva = bin2hex(random_bytes(4));
            $cliente->recuperarContraseña($correo, $claveNueva);
            return view('web.clave-nueva', compact('claveNueva'));
        } else {
            $msg = "El correo ingresado no esta asociado a ninguna cuenta";
            return view('web.recuperar-contraseña', compact('msg'));
        }
    }

    // public function ventanaClave()
    // {
    //     $claveNueva = "info@5.com";
    //     $cliente = new Cliente();
    //     $cliente->mostrarClave($claveNueva);
    //     return view('web.clave-nueva', compact('claveNueva'));
    // }
}
