@extends("web.plantilla")


@section('contenido')

<!-- Page Header Start -->
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Mi cuenta</h1>
      </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-6">
      <div class="container">
            <div class="heading_container">
                  <h2>Datos del usuario</h2>
            </div>
            @if (isset($msg))
            <div class="row">
                  <div class="col-12">
                        <?php echo $msg; ?>
                  </div>
            </div>
            @endif
            <div class="form_container mb-4">
                  <form id="form1" method="POST" class="mb-4">
                        <div class="row">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Nombre:</label>
                                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" required value="{{ $cliente->nombre }}">
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Apellido:</label>
                                    <input type="text" name="txtApellido" id="txtApellido" class="form-control" required value="{{ $cliente->apellido }}">
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Celular:</label>
                                    <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required value="{{ $cliente->telefono }}">
                              </div>
                              <div class="form-group col-lg-6 mb-3">
                                    <label>Correo:</label>
                                    <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" required value="{{ $cliente->correo }}">
                              </div>
                              <div class="col-6">
                                    <a href="/cambiarClave">Cambiar clave</a>
                              </div>
                              <div class="form-group col-12 d-flex justify-content-center mb-4">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Guardar</button>
                              </div>
                        </div>
                  </form>
            </div>

            <div class="heading_container mb-5">
                  <h2>Pedidos Activos</h2>
            </div>
            <table id="grilla" class="display table table-bordered table-hover">
                  <thead>
                        <tr>
                              <th>Fecha</th>
                              <th>Sucursal</th>
                              <th>Estado</th>
                              <th>Total</th>
                              <th>Método de Pago</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($aPedidos as $pedido) : ?>
                              <tr>
                                    <td><?= $pedido->fecha ?></td>
                                    <td><?= $pedido->fk_idsucursal ?></td>
                                    <td><?= $pedido->fk_idestado ?></td>
                                    <td><?= $pedido->total ?></td>
                                    <td><?= $pedido->metodo_pago ?></td>
                              </tr>
                        <?php endforeach; ?>
                  </tbody>
            </table>


      </div>
</div>

@endsection