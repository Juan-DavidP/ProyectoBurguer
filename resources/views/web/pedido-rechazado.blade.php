@extends('web.plantilla')
@section('contenido')
<div class="container-xxl py-6">
      <div class="row">
            <div class="col-8 mx-auto d-block alert-danger mt-5 text-center">
                  <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                  <strong>
                        <p class="mt-2" style="font-size: 22px;">Su pago ha sido rechazado.</p>
                  </strong>
                  <p class="pb-3" style="font-size: 20px;">por favor ponerse en contacto la sucursal para validar el estado de su pedido</p>
            </div>
            <div class="col-12 text-center mt-2"><a href="/carrito">Volver a su pedido</a></div>
      </div>
</div>

@endsection