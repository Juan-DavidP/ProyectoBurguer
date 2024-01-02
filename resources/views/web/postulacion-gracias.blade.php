@extends("web.plantilla")

@section('contenido')

<!-- Page Header Start -->
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Postulacion</h1>
    </div>
</div>
<!-- Page Header End -->
<div class="container-xxl py-5">
    <div class="container text-center">
        <h1 class="display-4">¡Gracias por tu postulación!</h1>
        <p class="lead">Pronto estará recibiendo noticias nuestras.</p>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver a la página principal</a>
    </div>
</div>
@endsection