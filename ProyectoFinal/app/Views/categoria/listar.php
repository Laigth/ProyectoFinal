<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div>
        <button class="btn btn-success mdi mdi-library-plus" onclick="location.href='<?= base_url('categoria/create') ?>'"> Agregar Categoria</button>
        <button id="toggleButton" class="btn btn-info mdi mdi mdi-eye"> Mostrar Categorias Deshabilitadas</button>
      </div>&nbsp;
      <h3>Lista Categorias</h3>
      <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="text-white bg-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Fecha de Registro</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categoria as $categoria) : ?>
              <tr>
                <td><?= $categoria['id'] ?></td>
                <td><?= $categoria['nombre'] ?></td>
                <td><?= $categoria['descripcion'] ?></td>
                <td><?= $categoria['fechaRegistro'] ?></td>
                <td>

                  <form action="<?= base_url('categoria/delete/' . $categoria['id']) ?>" method="POST">
                    <button type="button" class="btn btn-icon btn-primary btn-rounded mdi mdi-file-check" onclick="location.href='<?= base_url('categoria/editar/' . $categoria['id']) ?>'"></button>
                    <?php if ($categoria['estado'] == 1) : ?>
                      <button type="button" class="btn btn-icon btn-rounded btn-warning mdi mdi-account-off" onclick="location.href='<?= base_url('categoria/disable/' . $categoria['id']) ?>'"></button>
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
            <div id="disabledCategoria" style="display: none;">
              <h3>Categorias Deshabilitadas</h3>&nbsp;
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="text-white bg-dark">
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Fecha de Registro</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($categoria_deshabilitadas as $categoria) : ?>
                      <tr>
                        <td><?= $categoria['id'] ?></td>
                        <td><?= $categoria['nombre'] ?></td>
                        <td><?= $categoria['descripcion'] ?></td>
                        <td><?= $categoria['fechaRegistro'] ?></td>
                        <td>
                          <button type="button" class="btn btn-icon btn-rounded btn-success mdi mdi-account-check" onclick="location.href='<?= base_url('categoria/enable/' . $categoria['id']) ?>'"></button>
                        </td>
                        </form>
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
          var disabledCategoria = document.getElementById('disabledCategoria');
          if (disabledCategoria.style.display === 'none') {
            disabledCategoria.style.display = 'block';
            this.textContent = 'Ocultar Categorias Deshabilitadas';
          } else {
            disabledCategoria.style.display = 'none';
            this.textContent = 'Mostrar categorias Deshabilitadas';
          }
        });
      </script>
    </div>
  </div>
</div>

</div>
</div>
</div>
<style>
  .pagination li a {
    font-size: 18px;
    /* Ajusta el tamaño de la fuente */
    margin-right: 12px;
    /* Añade margen a la derecha */
  }

  .pagination-container {
    display: flex;
    justify-content: right;
  }
</style>