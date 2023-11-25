<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Agregar Categoria</h4>

            <form class="forms-sample" action="<?= base_url('categoria/store') ?>" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la Categoria" required>
              </div>

              <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción de la Categoria"></textarea>
              </div>

              <button type="submit" class="btn btn-primary me-2" value="Guardar">Agregar</button>
              <button type="button" class="btn btn-light" onclick="window.history.back();">Cancelar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>