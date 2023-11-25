<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2>Ventas</h2>&nbsp;

            <?php if (session()->has('errors')) : ?>
              <div class="alert alert-danger">
                <?php echo implode('<br>', session('errors')); ?>
              </div>
            <?php endif; ?>

            <form action="<?= base_url('ventas/crearVenta') ?>" method="post">

              <?php if (isset($cliente)) : ?>

                <div style="display: flex; justify-content: space-between; width: 60%;">
                  <input type="hidden" id="idCliente" name="idCliente" value=<?= $cliente['id'] ?> required />
                  <div style="margin-right: 20px;">
                    <label style="font-size: 17px; font-family: 'Times New Roman';">Nombre:&nbsp;&nbsp; </label>
                    <label style="font-size: 16px; font-family: 'Showcard Gothic'; color:blueviolet;"><?= $cliente['razonSocial'] ?></label>
                  </div>
                  <div>
                    <label style="font-size: 17px; font-family: 'Times New Roman';">CI/NIT:&nbsp;&nbsp; </label>
                    <label style="font-size: 16px; font-family: 'Showcard Gothic'; color:blueviolet;"><?= $cliente['ciNit'] ?></label>
                  </div>
                </div>&nbsp;
                <!-- Muestra más datos del cliente si es necesario -->
              <?php endif; ?>

              <h4>Seleccionar Productos</h4>
              <p class="card-description">
                Seleccion de Productos para su venta
              </p>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Producto:</label>
                    <div class="col-sm-9">
                      <!-- Elimina la carga inicial de productos en el datalist -->
                      <input list="productos" name="producto" id="producto" onchange="setPrecio(this.value)" class="form-control" placeholder="Ingresa el nombre del Producto" value="" autocomplete="off">
                      <datalist id="productos">
                        <?php foreach ($productos as $producto) : ?>
                          <option value="<?= $producto['nombreP'] ?>" data-precio="<?= $producto['precioBase'] ?>" data-id="<?= $producto['id'] ?>" data-stock="<?= $producto['stock'] ?>">
                          <?php endforeach; ?>
                      </datalist>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Precio:</label>
                    <div class="col-sm-9">
                      <input type="text" id="precio" class="form-control" disabled />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Cantidad: </label>
                    <div class="col-sm-9">
                      <input type="number" id="cantidadV" class="form-control" placeholder="Ingrese la cantidad de Compra" min="0" oninput="validarCantidad(this)" />
                    </div>
                  </div>
                </div>
                <input type="hidden" id="idProducto" name="idProducto" required />
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div>
                        <button type="button" onclick="agregarProducto()" class="btn btn-primary">
                          <i class="mdi mdi-cart-plus"></i> Agregar al carrito
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <h4>Detalle Venta</h4>&nbsp;
              <div>
                <!-- Tabla para mostrar los productos en el carrito -->
                <div class="table-responsive">
                  <table class="table table-striped" id="carrito">
                    <thead>
                      <tr class="text-white bg-dark">
                        <th>#</th>
                        <th>Nombre Producto</th>
                        <th>Precio Base</th>
                        <th>Cantidad</th>
                        <th>Precio Total</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $carrito = session()->get('carrito'); ?>
                      <?php if (!is_null($carrito)) : ?>
                        <?php foreach ($carrito as $index => $producto) : ?>
                          <tr>
                            <input type="hidden" name="carrito[<?= $index ?>][nombre]" value="<?= $producto['nombre'] ?>">
                            <input type="hidden" name="carrito[<?= $index ?>][precio]" value="<?= $producto['precio'] ?>">
                            <input type="hidden" name="carrito[<?= $index ?>][cantidadV]" value="<?= $producto['cantidadV'] ?>">
                            <td><?= $index + 1 ?></td>
                            <td><?= $producto['nombre'] ?></td>
                            <td><?= $producto['precio'] ?></td>
                            <td><input type="number" name="carrito[${table.rows.length - 2}][cantidadV]" value="${cantidad}" min="1" onchange="actualizarTotal()" /></td>
                            <td><?= $producto['total'] ?></td>
                            <!-- Aquí puedes agregar un botón o un enlace para eliminar un producto del carrito -->
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-6"></div>
                  <div class="col-sm-6">
                    <h4>
                      Total: &nbsp;<span id="totalVenta">0.00</span>&nbsp; Bs
                    </h4>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info" id="guardarVenta">Guardar Venta</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<script>
  function setPrecio(nombreProducto) {
    var option = document.querySelector('#productos option[value="' + nombreProducto + '"]');
    var precio = option.getAttribute('data-precio');
    var idProducto = option.getAttribute('data-id');
    document.getElementById('precio').value = precio;
    document.getElementById('idProducto').value = idProducto;
  }

  function agregarProducto() {
    var nombreProducto = document.getElementById('producto').value;
    var precio = document.getElementById('precio').value;
    var cantidad = Number(document.getElementById('cantidadV').value);

    if (cantidad <= 0 || isNaN(cantidad)) {
      alert('Por favor, ingresa una cantidad mayor que 0');
      return;
    }

    var option = document.querySelector('#productos option[value="' + nombreProducto + '"]');
    var stock = Number(option.getAttribute('data-stock'));

    var cantidadTotal = cantidad;
    var table = document.getElementById('carrito');
    for (var i = 1; i < table.rows.length; i++) {
      if (table.rows[i].cells[1].innerHTML === nombreProducto) {
        cantidadTotal += Number(table.rows[i].cells[3].innerHTML);
      }
    }

    if (cantidadTotal > stock) {
      alert('Productos insuficientes. La cantidad disponible de ' + nombreProducto + ' es ' + stock);
      return;
    }

    var row = table.insertRow(-1);

    row.innerHTML = `
        <input type="hidden" name="carrito[${table.rows.length - 2}][nombre]" value="${nombreProducto}">
        <input type="hidden" name="carrito[${table.rows.length - 2}][precioUnitario]" value="${precio}">
        <input type="hidden" name="carrito[${table.rows.length - 2}][cantidadV]" value="${cantidad}">
    `;

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    cell1.innerHTML = table.rows.length - 1;
    cell2.innerHTML = nombreProducto;
    cell3.innerHTML = precio;
    cell4.innerHTML = `<input type="number" name="carrito[${table.rows.length - 2}][cantidadV]" value="${cantidad}" min="1" onchange="actualizarTotal()" />`;
    cell5.innerHTML = (precio * cantidad).toFixed(2);

    var cell6 = row.insertCell(5);
    cell6.innerHTML = '<button class="btn btn-icon btn-rounded btn-primary mdi mdi-delete" onclick="eliminarProducto(this)"></button>';

    document.getElementById('producto').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('cantidadV').value = '';

    actualizarTotal();
  }

  function validarCantidad(input) {
    if (input.value < 0) {
      alert('No se aceptan números negativos');
      input.value = '';
    }
  }

  function actualizarTotal() {
    var table = document.getElementById('carrito');
    var totalVenta = 0;

    for (var i = 1; i < table.rows.length; i++) {
      var precio = parseFloat(table.rows[i].cells[2].innerHTML);
      var cantidad = parseInt(table.rows[i].cells[3].children[0].value);
      var total = precio * cantidad;

      table.rows[i].cells[4].innerHTML = total.toFixed(2);

      totalVenta += total;
    }

    document.getElementById('totalVenta').innerHTML = totalVenta.toFixed(2);

    var totalVentaInput = document.getElementById('totalVentaInput');
    if (!totalVentaInput) {
      totalVentaInput = document.createElement('input');
      totalVentaInput.type = 'hidden';
      totalVentaInput.id = 'totalVentaInput';
      totalVentaInput.name = 'totalVenta';
      document.forms[0].appendChild(totalVentaInput);
    }
    totalVentaInput.value = totalVenta.toFixed(2);
  }

  function eliminarProducto(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);

    var table = document.getElementById('carrito');
    for (var i = 1; i < table.rows.length; i++) {
      table.rows[i].cells[0].innerHTML = i;
    }

    actualizarTotal();
  }

  $('form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      success: function(pdfUrl) {
        if (pdfUrl !== 'Error') {
          window.open(pdfUrl, '_blank');
          window.location.href = '<?= base_url('ventas/listar') ?>';
        } else {
          alert('Ocurrió un error al crear la venta.');
        }
      }
    });
  });
</script>