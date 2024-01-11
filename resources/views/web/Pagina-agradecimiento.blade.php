@extends('web.plantilla')
@section('contenido')
<div class="container-xxl py-6">
      <div class="row">
            <div class="col-8 mx-auto d-block alert-success mt-5 text-center">
                  <img src="/files/" alt="">
                  <p class="mt-2" style="font-size: 20px;">Su compra se ha registrado correctamente, recuerde realizar el pago en la sucursal. </p>
                  <strong>
                        <p style="font-size: 22px;">Muchas gracias por su compra</p>
                  </strong>
            </div>
            <div class="col-12 text-center mt-2"><a href="/takeaway">Seguir viendo los productos</a></div>
      </div>
</div>

@endsection