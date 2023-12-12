@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<script>
      globalId = '';
      <?php $globalId = ""; ?>
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/productos">Productos</a></li>
      <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
      <li class="btn-item"><a title="Nuevo" href="/admin/sistema/cliente/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
      </li>
      @if($globalId > 0)
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
      @endif
      <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
      function fsalir() {
            location.href = "/admin/clientes";
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
      <form id="form1" method="POST">
            <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-lg-6">
                        <label>Nombre: *</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Cantidad: *</label>
                        <input type="text" id="txtCantidad" name="txtCantidad" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Precio: *</label>
                        <input type="text" id="txtPrecio" name="txtPrecio" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Descripción: *</label>
                        <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" required>
                        <script>
                              ClassicEditor
                                    .create(document.querySelector("#txtDescripcion"))
                                    .catch(error => {
                                          console.error(error);
                                    });
                        </script>
                  </div>
                  <div class="form-group col-lg-6">
                        <label>imagen: *</label>
                        <input type="file" id="imagen" name="imagen" class="form-control-file" accept=".jpg, .jpeg, .png" required>
                        <small class="d-block">Archivos admitidos: .jpg, .jpeg, .png</small>
                  </div>
            </div>
      </form>
</div>
@endsection