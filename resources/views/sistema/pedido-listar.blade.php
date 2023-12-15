@extends('plantilla')

@section('titulo', $titulo)

@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
    <li class="breadcrumb-item active">Pedidos</a></li>
</ol>
<ol class="toolbar">
    <!-- <li class="btn-item"><a title="Nuevo" href="/admin/pedidos/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li> -->
    <li class="btn-item"><a title="Recargar" href="#" class="fa fa-refresh" aria-hidden="true" onclick='window.location.replace("/admin/pedidos");'><span>Recargar</span></a></li>
</ol>
@endsection
@section('contenido')
<?php

use App\Entidades\Sistema\Pedido;

if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
$pedido = new Pedido();
$pedidos= $pedido->obtenerTodos();
?>
<table id="grilla" class="display table table-bordered table-hover">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Total</th>
            <th>CLiente</th>
            <th>Sucursal</th>
            <th>Estado</th>
            <th>Metodo de pago</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td>
                    <?php echo $pedido->fecha; ?>
                </td>
                <td>
                    <?php echo $pedido->total; ?>
                </td>
                <td>
                    <?php echo $pedido->cliente; ?>
                </td>
                <td>
                    <?php echo $pedido->sucursal; ?>
                </td>
                <td>
                    <?php echo $pedido->estado; ?>
                </td>
                <td>
                    <?php echo $pedido->metodo_pago; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection