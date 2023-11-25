<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url('images/imagenes/fondo-form.jpg') ?>" id="bg" alt="">

                        <h3>Agregar Doctor</h3>&nbsp;

                        <form class="forms-sample" action="<?= base_url('medicos/store') ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required>
                            </div>

                            <div class="form-group">
                                <label for="whatsapp">WhatsApp:</label>
                                <input type="number" class="form-control" name="whatsapp" id="whatsapp" placeholder="Celular o fijó" required>
                            </div>

                            <div class="form-group">
                                <label for="especialidad">Especialidad:</label>
                                <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="Especialidad del Veterinario" required>
                            </div>

                            <div class="form-group">
                                <label for="licencia">Licencia:</label>
                                <input type="text" class="form-control" name="licencia" id="licencia" placeholder="Número de Licencia" required>
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

<style>
    #bg {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
        /* Esto coloca la imagen detrás del contenido */
    }

    .card-body {
        background-image: url('<?= base_url('images/imagenes/fondo-form.jpg') ?>');
        background-size: cover;
        /* Esto hará que la imagen de fondo cubra todo el elemento */
        background-position: center;
        /* Esto centrará la imagen de fondo */
    }
</style>