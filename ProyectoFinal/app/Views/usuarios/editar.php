<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <img src="<?= base_url('images/imagenes/fondo-form.jpg') ?>" id="bg" alt="">

                        <h3>Datos del Usuario</h3>&nbsp;

                        <form class="forms-sample" action="<?= base_url('usuarios/update/' . $usuarios['id']) ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group">
                                <label for="nombre_usuario">Usuario:</label>
                                <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" value="<?= $usuarios['nombre_usuario'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="correo_electronico">Email:</label>
                                <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" value="<?= $usuarios['correo_electronico'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="whatsapp">WhatsApp:</label>
                                <input type="number" class="form-control" name="whatsapp" id="whatsapp" value="<?= $usuarios['whatsapp'] ?>" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary me-2" value="Guardar">Guardar</button>
                            <button type="button" class="btn btn-light" onclick="window.history.back();">Cancelar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>