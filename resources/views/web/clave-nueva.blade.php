@extends("web.plantilla")
@section('contenido')
<!-- Page Header Start -->
<!-- <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Ingresar</h1>
      </div>
</div> -->
<!-- Page Header End -->
<div id="msg"></div>
<?php
if (isset($msg)) {
      echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container text-center py-3">
                  <h2>Nueva contraseña</h2>
            </div>
            <div class="row">
                  <div class="alert-info offset-3 col-lg-6 p-5">
                        <p class="text-center">Su nueva clave es:</p>
                        <p class="text-center"><?php echo $claveNueva; ?></p>
                        <p>Recuerde cambiar su clave en mi cuenta una vez ingrese al sistema lo antes posible </p>
                  </div>
                  <div class="text-center mb-15 pt-5">
                        <a href="login">Ingresar a tu cuenta</a>
                  </div>
                  <div class="text-center">
                        <a href="registro">¿No tenes cuenta? Registrate</a>
                  </div>
            </div>
      </div>
</div>
@endsection