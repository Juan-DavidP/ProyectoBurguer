<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use Session;

class ControladorWebClaveNueva extends Controller
{
    public function index()
    {
        return view("web.clave-nueva");
    }

}