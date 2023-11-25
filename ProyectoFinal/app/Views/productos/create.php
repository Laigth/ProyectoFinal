<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Agregar Producto</h4>


                        <form action="<?= base_url('productos/store') ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="nombreP">Nombre:</label>
                                <input type="text" class="form-control" name="nombreP" id="nombreP" placeholder="Nombre del Producto" required>
                            </div>

                            <div class="form-group">
                                <label for="precioBase">Precio:</label>
                                <input type="number" name="precioBase" step="0.01" class="form-control" id="precioBase" placeholder="Precio Base" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" class="form-control" id="stock" placeholder="Cantidad en Stock" required>
                            </div>

                            <!-- Campo para editar la imagen -->
                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" name="imagen" class="form-control" id="imagen" placeholder="Imagen del Producto">
                            </div>
                            
                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <?php if ($categoria->estado == 1) : ?>
                                            <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fechaRegistro">Fecha de Registro:</label>
                                <input type="date" name="fechaRegistro" id="fechaRegistro" class="form-control">
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