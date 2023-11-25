<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Editar Categoria</h4>

            <form class="forms-sample" action="<?= base_url('categoria/update/' . $categoria['id']) ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $categoria['nombre'] ?>" required>
              </div>

              <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control"><?= $categoria['descripcion'] ?></textarea>
              </div>

              <button type="submit" class="btn btn-primary me-2" value="Guardar">Guardar Cambios</button>
              <button class="btn btn-light">Cancel</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>