<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Editar Cliente</h4>

            <form class="forms-sample" action="<?= base_url('clientes/update/' . $clientes['id']) ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="ciNit">Ci/Nit:</label>
                <input type="text" class="form-control" name="ciNit" id="ciNit" value="<?= $clientes['ciNit'] ?>" required>
              </div>

              <div class="form-group">
                <label for="razonSocial">Nombre:</label>
                <input type="text" name="razonSocial" id="razonSocial" class="form-control" value="<?= $clientes['razonSocial'] ?>">
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