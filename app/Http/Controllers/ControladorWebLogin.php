<?php

namespace App\Http\Controllers;

use Session;

class ControladorWebLogin extends Controller
{
    public function index()
    {
            return view("web.login");
    }
}