@extends("web.plantilla")

@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection

@section('contenido')

<!-- Page Header Start -->
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">TakeAway</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- Product Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Nuestros Productos</h1>
                </div>
            </div>
            <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" data-filter="*">Todos</a>
                    </li>
                    <?php foreach ($aCategorias as $categoria) : ?>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-<?php echo $categoria->idcategoria; ?>">
                                <?php echo $categoria->nombre; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    <?php foreach ($aProductos as $producto) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <form method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <div class="product-item card mb-4">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-fluid card-img-top" src="/files/<?php echo $producto->imagen; ?>" alt="<?php echo $producto->nombre; ?>">
                                        <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Nuevo</div>
                                    </div>
                                    <div class="card-body text-center">
                                        <a class="card-title h5 mb-2"><?php echo $producto->nombre; ?></a>
                                        <p class="card-text text-primary">$<?php echo number_format($producto->precio, 2, ",", "."); ?></p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <div class="w-50 text-center border-end py-2">
                                            <p class="card-text text-body"><?php echo $producto->descripcion; ?></p>
                                        </div>
                                        <div class="w-50 text-center py-2">
                                            <input type="hidden" class="form-control mb-2" id="txtIdProducto" name="txtIdProducto" value="<?php echo $producto->idproducto; ?>">
                                            <label for="txtCantidad" class="visually-hidden">Cantidad</label>
                                            <input type="number" class="form-control mb-2" id="txtCantidad" name="txtCantidad" value="0" min="0">
                                            <button class="btn btn-primary" type="submit" name="btnAgregarCarrito">
                                                <i class="fa fa-shopping-bag me-2"></i>Añadir al carrito
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary rounded-pill py-3 px-5">Explorar más productos</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Product End -->

@endsection