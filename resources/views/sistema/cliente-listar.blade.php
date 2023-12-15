@extends('plantilla')

@section('titulo', $titulo)

@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
    <li class="breadcrumb-item active">Clientes</a></li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/cliente/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Recargar" href="#" class="fa fa-refresh" aria-hidden="true" onclick='window.location.replace("/admin/clientes");'><span>Recargar</span></a></li>
</ol>
@endsection
@section('contenido')
<?php

use App\Entidades\Sistema\Cliente;

if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
$cliente = new Cliente();
$clientes= $cliente->obtenerTodos();
?>
<table id="grilla" class="display table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Correo</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td>
                    <?php echo $cliente->nombre; ?>
                </td>
                <td>
                    <?php echo $cliente->apellido; ?>
                </td>
                <td>
                    <?php echo $cliente->dni; ?>
                </td>
                <td>
                    <?php echo $cliente->correo; ?>
                </td>
                <td>
                    <?php echo $cliente->telefono; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection