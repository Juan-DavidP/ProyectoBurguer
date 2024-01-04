@extends("web.plantilla")
@section('contenido')

<!-- Page Header Start -->
<!-- <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Ingresar</h1>
      </div>
</div> -->
<!-- Page Header End -->

<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container text-center pt-5">
                  <h2>Recuperar contraseña</h2>
            </div>
            <div class="form_container mb-4">
                  <form id="form1" method="POST" class="mb-4">
                        <div class="row">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-group offset-3 col-lg-6 mb-3">
                                    <label class="mb-2">Correo:</label>
                                    <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" required value="">
                              </div>
                              @if(isset($msg))
                              <div class="alert-danger mb-3">
                                    <p class="text-center pt-3"><?php echo $msg; ?></p>
                              </div>
                              @endif
                              <div class="form-group col-12 d-flex justify-content-center mb-4">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Recuperar</button>
                              </div>
                              <div class="text-center">
                                    <a href="login">Ingresar a tu cuenta</a>
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