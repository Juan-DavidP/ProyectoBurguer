@extends("web.plantilla")
@section('contenido')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="web/img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <h1 class="display-2 mb-5 animated slideInDown">Bienvenido al Paraíso de las Hamburguesas</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="web/img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <h1 class="display-2 mb-5 animated slideInDown">Descubre un Mundo de Sabores Únicos en Cada Bocado</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->









<!-- Blog Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Nuestras Sucursales</h1>
            <p>¡Ven y descubre la esencia de nuestras sucursales, donde la calidad se fusiona con la calidez en cada rincón!</p>
        </div>
        <div class="row g-4">
            <?php foreach ($aSucursales as $sucursal) : ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light p-4">
                        <div class="position-relative bg-light overflow-hidden text-center">
                            <h4 class="mb-3"><a class="text-primary"><?php echo $sucursal->nombre; ?></a></h4>
                        </div>
                        <div class="text-center p-4">
                            <a class="d-block h5 mb-2"><?php echo $sucursal->telefono; ?></a>
                            <span class="text-primary me-1"><?php echo $sucursal->direccion; ?></span>
                        </div>
                        <div class="d-flex border-top">
                            <small class="w-50 text-center border-end py-2">
                                <a class="text-body"><?php echo $sucursal->estado_sucursal; ?></a>
                            </small>
                            <small class="w-50 text-center py-2">
                                <a class="text-body" href="<?php echo $sucursal->mapa; ?>" target="_blank">
                                    <i class="fa fa-solid fa-map text-primary me-2"></i>Mapa
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Blog End -->
@endsection