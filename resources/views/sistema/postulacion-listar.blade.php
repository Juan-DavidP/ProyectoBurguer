@extends('plantilla')

@section('titulo', $titulo)

@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
    <li class="breadcrumb-item active">Postulación</a></li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/postulacion/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Recargar" href="#" class="fa fa-refresh" aria-hidden="true" onclick='window.location.replace("/admin/postulaciones");'><span>Recargar</span></a></li>
</ol>
@endsection
@section('contenido')
<?php

use App\Entidades\Sistema\Postulacion;

if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
$postulacion = new Postulacion();
$postulaciones= $postulacion->obtenerTodos();
?>
<table id="grilla" class="display table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($postulaciones as $postulacion): ?>
            <tr>
                <td>
                    <?php echo $postulacion->nombre; ?>
                </td>
                <td>
                    <?php echo $postulacion->apellido; ?>
                </td>
                <td>
                    <?php echo $postulacion->telefono; ?>
                </td>
                <td>
                    <?php echo $postulacion->direccion; ?>
                </td>
                <td>
                    <?php echo $postulacion->correo; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection