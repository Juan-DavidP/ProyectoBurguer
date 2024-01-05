@extends("web.plantilla")
@section('contenido')

<!-- Page Header Start -->
<!-- <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Registrate</h1>
      </div>
</div> -->
<!-- Page Header End -->

<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container pt-5">
                  <h2>Datos del usuario</h2>
            </div>
            <div class="form_container mb-4">
                  <form id="form1" method="POST" class="mb-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="row">
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Nombre:</label>
                                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Apellido:</label>
                                    <input type="text" id="txtApellido" name="txtApellido" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Correo:</label>
                                    <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Clave:</label>
                                    <input type="password" id="txtClave" name="txtClave" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Teléfono:</label>
                                    <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Repetir clave:</label>
                                    <input type="password" id="txtRepetirClave" name="txtRepetirClave" class="form-control" required>
                              </div>
                              <div id="msg"></div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>DNI:</label>
                                    <input type="text" id="txtDni" name="txtDni" class="form-control" required>
                              </div>
                              @if(isset($msg))
                                    <div class="col-lg-6">
                                          <div class="alert-danger ps-3"><?php echo $msg; ?></div>
                                    </div>
                              @endif
                              <div class="form-group col-12 d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Registrar</button>
                              </div>
                              <a href="/login">Ingresar a tu cuenta</a>
                              <a href="/recuperar-contraseña">¿olvidaste tu contraseña?</a>
                        </div>
                  </form>
            </div>
      </div>
</div>

@endsection