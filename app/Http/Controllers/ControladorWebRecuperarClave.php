<?php

namespace App\Http\Controllers;

use Session;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
            return view("web.recuperarContraseña");
    }
}