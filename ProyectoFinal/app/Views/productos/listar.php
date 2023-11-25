<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h3>Lista de Productos</h3>&nbsp;
      <div>
        <button class="btn btn-success mdi mdi-library-plus" onclick="location.href='<?= base_url('productos/create') ?>'"> Agregar producto</button>
        <button id="toggleButton" class="btn btn-info mdi mdi mdi-eye"> Mostrar Productos Deshabilitados</button>
      </div>&nbsp;&nbsp;
       <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="text-white bg-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Imagen</th>
              <th>Fecha de Registro</th>
              <th>Categoria</th>
              <th style="text-align: center;">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($productos as $producto) : ?>
              <tr>
                <td><?= $producto['id'] ?></td>
                <td><?= $producto['nombreP'] ?></td>
                <td><?= $producto['precioBase'] . ' Bs' ?></td>
                <td><?= $producto['stock'] ?></td>
                <td><img src="<?= base_url('uploads/' . $producto['imagen']); ?>" width="100" height="100"></td>
                <td><?= $producto['fechaRegistro'] ?></td>
                <td><?= $producto['idCategoria'] ?></td>
                <td>

                  <form action="<?= base_url('productos/delete/' . $producto['id']) ?>" method="post">
                    <button type="button" class="btn btn-icon btn-rounded btn-primary mdi mdi-file-check" onclick="location.href='<?= base_url('productos/edit/' . $producto['id']) ?>'"></button>
                    <?php if ($producto['estado'] == 1) : ?>
                      <button type="button" class="btn btn-icon btn-rounded btn-warning mdi mdi-account-off" onclick="location.href='<?= base_url('productos/disable/' . $producto['id']) ?>'"></button>
                    <?php endif; ?>
                    <?php if (session()->get('tipo_usuario') == 'administrador') : ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-icon btn-rounded btn-danger mdi mdi-delete"></button>
                    <?php endif; ?>
                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div id="disabledProducts" style="display: none;">
              <h3>Productos Deshabilitados</h3>&nbsp;
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="text-white bg-dark">
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Stock</th>
                      <th>Imagen</th>
                      <th>Categoria</th>
                      <th>Fecha de Registro</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos_deshabilitados as $producto) : ?>
                      <tr>
                        <td><?= $producto['id'] ?></td>
                        <td><?= $producto['nombreP'] ?></td>
                        <td><?= $producto['precioBase'] . ' Bs' ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td><img src="<?= base_url('uploads/' . $producto['imagen']); ?>" width="100" height="100"></td>
                        <td><?= $producto['fechaRegistro'] ?></td>
                        <td><?= $producto['idCategoria'] ?></td>
                        <td>
                          <button type="button" class="btn btn-icon btn-rounded btn-success mdi mdi-account-check" onclick="location.href='<?= base_url('productos/enable/' . $producto['id']) ?>'"></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
          var disabledProducts = document.getElementById('disabledProducts');
          if (disabledProducts.style.display === 'none') {
            disabledProducts.style.display = 'block';
            this.textContent = 'Ocultar Productos Deshabilitados';
          } else {
            disabledProducts.style.display = 'none';
            this.textContent = 'Mostrar Productos Deshabilitados';
          }
        });
      </script>

    </div>
  </div>
</div>