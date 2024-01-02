@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<script>
      globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
      <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
      <li class="breadcrumb-item active">Ver pedido</li>
</ol>
<ol class="toolbar">
      <!-- <i class="fa-solid fa-arrows-rotate" style="color: #136fe7;">prueba</i> -->
      <li class="btn-item"><a title="Recargar" href="/admin/pedidos/ver-pedido/<?php echo $pedido->idpedido ?>" class="fa fa-plus-circle" aria-hidden="true"><span>Recargar</span></a></li>
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
      </li>
      <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
      function fsalir() {
            location.href = "/admin/pedidos";
      }
</script>
@endsection
@section('contenido')
<div class="panel-body">
      <div id="msg"></div>
      <?php
      if (isset($msg)) {
            echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
      }
      ?>
      <form id="form1" method="POST" class="form-secondary">
            <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="col-lg-12 ">
                        @foreach ($aProductosPedido as $producto)
                        <label class="form-control">Pedido # <?php echo $producto->idproductopedido ?> </label>
                        @endforeach
                  </div>
                  <div class="form-group col-lg-6">
                        <label> Cliente:</label>
                        <input type="text" id="txtCliente" name="txtCliente" class="form-control" value="{{$pedido->fk_idcliente}}" disabled>
                  </div>
                  <div class="col-lg-6">
                        <img src="/public/files/2023122708124017.jpg" alt="" srcset="">
                        <label>Sucursal:</label>
                        <input type="text" id="txtSucursal" name="txtSucursal" class="form-control" value="{{$pedido->fk_idsucursal}}" disabled>
                  </div>
                  <div class="form-group col-lg-6">
                        <label> Fecha y Hora:</label>
                        <input type="text" id="txtFecha" name="txtFecha" class="form-control" value="{{$pedido->fecha}}" disabled>
                  </div>
                  <div class="col-lg-6">
                        <label>Estado:</label>
                        <select name="lstEstado" id="lstEstado" class="form-control">
                              <option value="" disabled>Seleccionar</option>
                              @foreach ($aEstados as $estado)
                              @if($pedido->fk_idestado == $estado->nombre)
                              <option selected value="<?php echo $estado->idestado; ?>"> <?php echo $estado->nombre; ?></option>
                              @else
                              <option value="<?php echo $estado->idestado; ?>"> <?php echo $estado->nombre; ?></option>
                              @endif
                              @endforeach
                        </select>
                  </div>
                  <div class="col-lg-6 form-group">
                        <label>Comentarios:</label>
                        <textarea name="txtComentarios" id="txtComentarios" class="form-control" disabled style="height:100px !important">
                              <?php echo $pedido->comentario ?>
                        </textarea>
                  </div>
                  <div class="col-lg-6">
                        <label>Metodo de pago:</label>
                        <select name="lstMetodoPago" id="lstMetodoPago" class="form-control">
                              @foreach ($metodos_pago as $pago)
                              @if ($pedido->metodo_pago == $pago)
                              <option selected value="<?php echo $pago ?>"><?php echo $pago ?></option>
                              @else
                              <option value="<?php echo $pago ?>"><?php echo $pago ?></option>
                              @endif
                              @endforeach
                        </select>
                  </div>
            </div>
      </form>
      <div class="row mt-5">
            <div class="col-lg-12">
                  <table class="table border">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Extras</th>
                                    <th>Ingredientes a quitar</th>
                                    <th>Precio</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php $total = 0; ?>
                              @foreach ($aProductosPedido as $producto)
                              <tr>
                                    <td><img src="/files/<?php echo $producto->imagen ?>" alt="Imagen del producto" class="img-thumbnail" width="150px"></td>
                                    <td><?php echo $producto->nombre ?></td>
                                    <td><?php echo $producto->cantidad ?></td>
                                    <td></td>
                                    <td><?php echo $producto->descripcion ?></td>
                                    <td><?php echo $producto->precio ?></td>
                              </tr>
                              <?php $total += $producto->cantidad * $producto->precio; ?>
                              @endforeach
                        </tbody>
                        <tfoot>
                              <td colspan="5" class="text-right h3">Total:</td>
                              <td><?php echo number_format($total, "0", ",", "."); ?></td>
                        </tfoot>
                  </table>

            </div>
      </div>
</div>
<?php // echo $producto->imagen 
?>

<script>
      function guardar() {
            if ($("#form1").valid()) {
                  modificado = false;
                  form1.submit();
            } else {
                  $("#modalGuardar").modal('toggle');
                  msgShow("Corrija los errores e intente nuevamente.", "danger");
                  return false;
            }
      }
</script>
@endsection