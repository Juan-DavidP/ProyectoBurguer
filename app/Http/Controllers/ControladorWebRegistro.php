<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ControladorWebRegistro extends Controller
{
      public function index()
      {
            return view("web.registro");
      }

      public function registrar(Request $request)
      {
             print_r( $request->input('txtNombre'));
             print_r( $request->input('txtApellido'));
             print_r( $request->input('txtCorreo'));
             print_r( $request->input('txtClave'));
             print_r( $request->input('txtTelefono'));
             print_r( $request->input('txtDni'));
      }
}
