<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Agregar Cliente</h4>
           
            <form class="forms-sample" action="<?= base_url('clientes/store') ?>" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="ciNit">Ci/Nit:</label>
                <input type="" name="ciNit" id="ciNit" class="form-control" placeholder="Número de Carnet ó Nit" required>
              </div>

              <div class="form-group">
                <label for="razonSocial">Nombre:</label>
                <input type="text" class="form-control" name="razonSocial" id="razonSocial" placeholder="Nombre del Cliente" required>
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