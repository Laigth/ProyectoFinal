<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div>
                <button class="btn btn-success mdi mdi-account-plus" onclick="location.href='<?= base_url('usuarios/register') ?>'"> Registrar Usuarios</button>
                <button id="toggleButton" class="btn btn-info mdi mdi-eye"> Usuarios Deshabilitados</button>
            </div>

            <div class="col-lg-14 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Usuarios</h4>

                        <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="text-white bg-dark">
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Usuario</th>
                                        <th style="text-align: center;">Correo</th>
                                        <th style="text-align: center;">WhatsApp</th>
                                        <th style="text-align: center;">Tipo Usuario</th>
                                        <th style="text-align: center;">Fecha de Registro</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $usuario['id'] ?></td>
                                            <td style="text-align: center;"><?= $usuario['nombre_usuario'] ?></td>
                                            <td style="text-align: center;"><?= $usuario['correo_electronico'] ?></td>
                                            <td style="text-align: center;"><?= $usuario['whatsapp'] ?></td>
                                            <td style="text-align: center;"><?= $usuario['tipo_usuario'] ?></td>
                                            <td style="text-align: center;"><?= $usuario['fechaRegistro'] ?></td>
                                            <td style="text-align: center;">

                                                <form action="<?= base_url('usuarios/delete/' . $usuario['id']) ?>" method="post">
                                                    <button type="button" class="btn btn-icon btn-primary btn-rounded mdi mdi-file-check" onclick="location.href='<?= base_url('usuarios/editar/' . $usuario['id']) ?>'"></button>
                                                    <?php if ($usuario['estado'] == 1) : ?>
                                                        <button type="button" class="btn btn-icon btn-rounded btn-danger mdi mdi-account-off" onclick="location.href='<?= base_url('usuarios/disable/' . $usuario['id']) ?>'"></button>
                                                    <?php endif; ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-icon btn-rounded btn-dark mdi mdi-account-remove"></button>
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
                                        <h4> Usuarios Deshabilitados</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead class="text-white bg-dark">
                                                    <tr>
                                                        <th style="text-align: center;">ID</th>
                                                        <th style="text-align: center;">Usuario</th>
                                                        <th style="text-align: center;">Correo</th>
                                                        <th style="text-align: center;">WhatsApp</th>
                                                        <th style="text-align: center;">Tipo Usuario</th>
                                                        <th style="text-align: center;">Fecha de Registro</th>
                                                        <th style="text-align: center;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($usuarios_deshabilitados as $usuario) : ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?= $usuario['id'] ?></td>
                                                            <td style="text-align: center;"><?= $usuario['nombre_usuario'] ?></td>
                                                            <td style="text-align: center;"><?= $usuario['correo_electronico'] ?></td>
                                                            <td style="text-align: center;"><?= $usuario['whatsapp'] ?></td>
                                                            <td style="text-align: center;"><?= $usuario['tipo_usuario'] ?></td>
                                                            <td style="text-align: center;"><?= $usuario['fechaRegistro'] ?></td>
                                                            <td style="text-align: center;">

                                                                <button type="button" class="btn btn-icon btn-rounded btn-success mdi mdi-account-check" onclick="location.href='<?= base_url('usuarios/enable/' . $usuario['id']) ?>'"></button>
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
                                    this.textContent = ' Usuarios Deshabilitados';
                                } else {
                                    disabledProducts.style.display = 'none';
                                    this.textContent = ' Usuarios Deshabilitados';
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
<!-- content-wrapper ends -->