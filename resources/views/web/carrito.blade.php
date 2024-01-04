@extends('web.plantilla')
@section('contenido')

<div class="container-xxl py-6">
      <div class="heading_container text-center pt-5">
            <h2>Mi carrito</h2>
      </div>
      <div class="panel-body">
            <div id="msg"></div>
            <div class="row mt-5">
                  <div class="col-lg-12">
                        <table class="table border">
                              <thead>
                                    <tr>
                                          <th></th>
                                          <th>Nombre</th>
                                          <th>Cantidad</th>
                                          <th>Extras</th>
                                          <th>Descripción</th>
                                          <th>Precio</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php $total = 0; ?>
                                    @foreach($aProductos as $producto)
                                    <tr>
                                          <td><img src="/files/<?php echo $producto->imagen ?>" alt="Imagen del producto" class="img-thumbnail" width="150px"></td>
                                          <td><?php echo $producto->nombre ?></td>
                                          <td><?php echo $producto->cantidad ?></td>
                                          <td></td>
                                          <td><?php echo $producto->descripcion ?></td>
                                          <td><?php echo $producto->precio ?></td>
                                          <?php $total += $producto->cantidad * $producto->precio; ?>
                                    </tr>
                                    @endforeach
                              </tbody>
                              <tfoot>
                                    <td colspan="5" class="text-right h3">Total:</td>
                                    <td><?php echo number_format($total, "0", ",", "."); ?></td>
                              </tfoot>
                        </table>

                  </div>
            </div>
      </div>
</div>
@endsection