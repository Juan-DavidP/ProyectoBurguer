<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebCambiarClave extends Controller
{

      public function index()
      {
            if (Session::get('idcliente') > 0) {
                  return view('web.cambiarClave');
            }
            else {
                  return redirect('/login');
            }
      }

      public function cambiarClave(Request $request)
      {
            $cliente = new Cliente();

            $aCliente = $cliente->obtenerPorId(Session::get('idcliente'));
            if (password_verify($request->input('txtClave'), $aCliente->clave)) {
                  if ($request->input('txtclaveNueva') == $request->input('txtRepetirClave')) {
                        $cliente->clave = password_hash($request->input('txtclaveNueva'), PASSWORD_DEFAULT);
                        $cliente->actualizarClave();
                        $msg = "Se actualizo la clave correctamente";
                        // return redirect('/mi-cuenta');
                        return redirect('/mi-cuenta')->with('msg', $msg);
                  } else {
                        $msg = "Las claves no coinciden, por favor intentelo nuevamente";
                        return view('web.cambiarClave', compact('msg'));
                  }
            } else {
                  $msg = "La clave ingresada es incorrecta, por favor intentelo nuevamente";
                  return view('web.cambiarClave', compact('msg'));
            }
      }
}
