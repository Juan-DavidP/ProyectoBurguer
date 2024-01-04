<?php

namespace App\Http\Controllers;
use Session;

class ControladorWebLogout extends Controller
{
    public function salir()
    {
        Session::put("idcliente", "");
        return redirect("/");
    }
}
