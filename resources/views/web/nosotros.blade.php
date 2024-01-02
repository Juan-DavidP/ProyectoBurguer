@extends("web.plantilla")
@section('contenido')

<!-- Page Header Start -->
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Sobre Nosotros</h1>
    </div>
</div>
<!-- Page Header End -->

<!-- Firm Visit Start -->
<div class="container-fluid bg-primary bg-icon mt-5 py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="display-5 text-black mb-3">Donde la Pasión por las Hamburguesas se Encuentra con la Excelencia en Cada Bocado</h2>
                <p class="text-white mb-0">Bienvenidos a [Nombre de la Página], el destino definitivo para los amantes de las hamburguesas. En nuestro apasionado mundo gastronómico, fusionamos creatividad y calidad para ofrecerte experiencias únicas de sabor en cada hamburguesa. Desde la selección cuidadosa de ingredientes frescos hasta la preparación artesanal de nuestras recetas exclusivas, nos esforzamos por elevar cada bocado a un nivel de excelencia inigualable..</p>
            </div>
        </div>
    </div>
</div>
<!-- Firm Visit End -->


<!-- Testimonial Start -->
<div class="container-fluid bg-light bg-icon py-6 mb-5">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Opinión del Cliente</h1>
            <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="web/img/testimonial-1.jpg" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">[Nombre del Cliente]</h5>
                        <span>[Profesión]</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="web/img/testimonial-2.jpg" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">[Nombre del Cliente]</h5>
                        <span>[Profesión]</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="web/img/testimonial-3.jpg" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">[Nombre del Cliente]</h5>
                        <span>[Profesión]</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="web/img/testimonial-4.jpg" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">[Nombre del Cliente]</h5>
                        <span>[Profesión]</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->



<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="display-5 mb-4">Trabaja con Nosotros</h1>
                <p class="mb-4">Explora emocionantes oportunidades profesionales y únete a nuestro talentoso equipo. Creemos en la innovación, el crecimiento y el trabajo en equipo. Descubre cómo puedes contribuir y crecer con nosotros. ¡Trabaja con Nosotros y haz parte de una experiencia laboral excepcional!</p>

                <form id="form1" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-6 mb-3">
                            <label for="txtNombre" class="form-label">Nombre: *</label>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="txtApellido" class="form-label">Apellido: *</label>
                            <input type="text" name="txtApellido" id="txtApellido" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="txtTelefono" class="form-label">Teléfono: *</label>
                            <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="txtDireccion" class="form-label">Dirección: *</label>
                            <input type="text" name="txtDireccion" id="txtDireccion" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="txtCorreo" class="form-label">Correo: *</label>
                            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="cv" class="form-label">Curriculum: *</label>
                            <input type="file" id="cv" name="cv" class="form-control" accept=".pdf, .doc, .docx, .txt" required>
                            <small class="form-text text-muted">Archivos admitidos: PDF, DOC, DOCX, TXT</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary" type="submit">Enviar Solicitud</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- About End -->



@endsection