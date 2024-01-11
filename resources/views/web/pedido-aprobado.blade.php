@extends("web.plantilla")
@section('contenido')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Su pago se ha realizado correctamente</h1>

      </div>
</div>
<div class="container-xxl py-6">
      <div class="container">
            <div class="row g-5 justify-content-center">
                  <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                        <p class="mb-4">Muchas gracias por su compra.</p>
                        <a href="/takeaway" class="btn btn-primary">Seguir viendo los productos</a>
                  </div>
            </div>
      </div>
</div>
@endsection