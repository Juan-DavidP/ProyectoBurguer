@extends("web.plantilla")
@section('contenido')

<!-- Page Header Start -->

<!-- Page Header End -->

<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container text-center py-3">
                  <h2>Ingresar</h2>
            </div>
            <div class="form_container mb-4">
                  <form id="form1" action="POST" class="mb-4">
                        <div class="row">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-group offset-3 col-lg-6 mb-3">
                                    <label>Correo:</label>
                                    <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" required value="">
                              </div>
                              <div class="form-group offset-3  col-lg-6 mb-3">
                                    <label>Clave:</label>
                                    <input type="text" id="txtClave" name="txtClave" class="form-control" required value="">
                              </div>
                              <div class="form-group col-12 d-flex justify-content-center mb-4">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Ingresar</button>
                              </div>
                              <div class="text-center">
                                    <a href="recuperar-contraseña">¿Olvidaste la clave?</a>
                              </div>
                              <div class="text-center">
                                    <a href="registro">¿No tenes cuenta? Registrate</a>
                              </div>
                        </div>
                  </form>
            </div>

           
      </div>
</div>

@endsection
