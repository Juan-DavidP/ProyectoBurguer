@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<script>
      globalId = '<?php echo isset($producto->idproducto) && $producto->idproducto > 0 ? $producto->idproducto : 0; ?>';
      <?php $globalId = isset($producto->idproducto) ? $producto->idproducto : "0"; ?>
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
      <li class="btn-item"><a title="Nuevo" href="/admin/producto/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
      </li>
      @if($globalId > 0)
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
      @endif
      <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
      function fsalir() {
            location.href = "/admin/productos";
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
      <form id="form1" method="POST" enctype="multipart/form-data">
            <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-lg-6">
                        <label>Nombre: *</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" required value="{{ $producto->nombre }}">
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Cantidad: *</label>
                        <input type="text" id="txtCantidad" name="txtCantidad" class="form-control" required value="{{ $producto->cantidad }}">
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Precio: *</label>
                        <input type="text" id="txtPrecio" name="txtPrecio" class="form-control" required value="{{ $producto->precio }}">
                  </div>
                  <div class="form-group col-lg-6">
                        <label>Categoría: *</label>
                        <select type="text" id="lstCategoria" name="lstCategoria" class="form-control selectpicker" data-live-search="true" required>
                              <option value="" disabled selected>Seleccionar</option>
                              <?php foreach ($aCategorias as $tipo) : ?>
                                    <option value="<?php echo $tipo->idcategoria; ?>" <?php echo ($tipo->idcategoria == $producto->fk_idcategoria) ? 'selected' : ''; ?>><?php echo $tipo->nombre; ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div class="form-group col-lg-12">
                        <label>Descripción: *</label>
                        <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" required">{{ $producto->descripcion }}</textarea>
                        <script>
                              ClassicEditor
                                    .create(document.querySelector("#txtDescripcion"))
                                    .catch(error => {
                                          console.error(error);
                                    });
                        </script>
                  </div>
                  <div class="form-group col-lg-12">
                        <label>Imagen: *</label>
                        <input type="file" id="imagen" name="imagen" class="form-control-file" accept=".jpg, .jpeg, .png" <?php echo $producto->idproducto > 0 ? "" : "required"; ?>>
                        <small class="d-block">Archivos admitidos: .jpg, .jpeg, .png</small>
                  </div>


            </div>
      </form>
</div>
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

      function eliminar() {
            $.ajax({
                  type: "GET",
                  url: "{{ asset('admin/producto/eliminar') }}",
                  data: {
                        id: globalId
                  },
                  async: true,
                  dataType: "json",
                  success: function(data) {
                        if (data.err == "OK") {
                              msgShow("Registro eliminado exitosamente.", "success");
                        } else {
                              msgShow(data.err, "danger");
                        }
                        $('#mdlEliminar').modal('toggle');
                  }
            });
      }
</script>
@endsection