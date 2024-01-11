@extends('web.plantilla')
@section('contenido')
<form action="" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
      <div class="container-xxl py-6">
            <div class="heading_container text-center pt-5">
                  <h2>Mi carrito</h2>
            </div>
            @if(count($aProductos) > 0)
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
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Eliminar</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php $total = 0; ?>
                                          @foreach($aProductos as $producto)
                                          <tr>
                                                <td><img src="/files/<?php echo $producto->imagen ?>" alt="Imagen del producto" class="img-thumbnail" width="150px"></td>
                                                <td><?php echo $producto->nombre ?></td>
                                                <td><?php echo $producto->cantidad ?></td>
                                                <td><?php echo $producto->descripcion ?></td>
                                                <td><?php echo number_format($producto->precio, 0, ",", ".") ?></td>
                                                <td><a href="/carrito/eliminar/<?php echo  $producto->idcarritoproducto; ?>" class="btn btn-danger">Eliminar</a></td>
                                                <?php $total += $producto->cantidad * $producto->precio; ?>
                                          </tr>
                                          @endforeach
                                    </tbody>
                                    <tfoot>
                                          <td colspan="5" class="text-right h3">Total:</td>
                                          <td><?php echo number_format($total, 0, ",", "."); ?></td>
                                    </tfoot>
                              </table>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-6">
                              <label for="lstMetodoDePago">Seleccionar método de pago</label>
                              <select name="lstMetodoDePago" id="lstMetodoDePago" class="form-control mt-2">
                                    <option value="sucursal">Pago en sucursal</option>
                                    <option value="mercadopago">Mercadopago</option>
                              </select>
                        </div>
                        <div class="col-6">
                              <label for="lstSucursal">Seleccione la sucursal</label>
                              <select name="lstSucursal" id="lstSucursal" class="form-control mt-2">
                                    @foreach($aSucursales as $sucursal)
                                    <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                              </select>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-12 py-5">
                              <button name="btnComprar" type="submit" class="btn btn-primary mx-auto d-block">Finalizar compra</button>
                        </div>
                  </div>
            </div>
            @else
            <div class="row">
                  <div class="col-12 text-center pt-5">
                        <p>No hay productos en el carrito </p>
                        <a href="/takeaway">Ver productos</a>
                  </div>
            </div>
            @endif
      </div>

</form>
@endsection