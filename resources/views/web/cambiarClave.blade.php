@extends("web.plantilla")


@section('contenido')

<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container pt-5">
                  <h2>Datos del usuario</h2>
            </div>
            <div class=" mb-4">
                  <form id="form1" method="POST" class="mb-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="row">
                              <div class="form-group col-lg-4 mb-3">
                                    <label>Clave actual:</label>
                                    <input type="password" id="txtClave" name="txtClave" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-4 mb-3">
                                    <label>nueva clave:</label>
                                    <input type="password" id="txtNuevaClave" name="txtclaveNueva" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-4 mb-3">
                                    <label>Repetir clave:</label>
                                    <input type="password" id="txtRepetirClave" name="txtRepetirClave" class="form-control" required>
                              </div>
                              @if(isset($msg))
                              <div class="col-lg-12">
                                    <div class="alert-danger p-3 text-center"><?php echo $msg; ?></div>
                              </div>
                              @endif
                              <div class="form-group col-12 d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Cambiar clave</button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
</div>