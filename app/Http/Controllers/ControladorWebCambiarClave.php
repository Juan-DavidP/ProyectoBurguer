<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebCambiarClave extends Controller
{

      public function index()
      {
            return view('web.cambiarClave');
      }

      public function cambiarClave(Request $request)
      {
            $cliente = new Cliente();
            $aCliente = $cliente->obtenerPorId(Session::get('idcliente'));
            if ($request->input('txtClave') == $aCliente->clave) {
                  if ($request->input('txtclaveNueva') == $request->input('txtRepetirClave')) {
                        $cliente->clave = $request->input('txtclaveNueva');
                        $cliente->actualizarClave();
                        $msg="Se actualizo la clave correctamente";
                        return view('web.mi-cuenta',compact('msg'));
                  } else {
                        $msg = "Las claves ingresadas no son iguales, por favor intentelo nuevamente";
                        return view('web.cambiarClave', compact('msg'));
                  }
            }else {
                  $msg = "La clave ingresada es incorrecta, por favor intentelo nuevamente";
                  return view('web.cambiarClave', compact('msg'));
            }
      }
}
