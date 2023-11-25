            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div>
                            <button class="btn btn-success mdi mdi-library-plus" onclick="location.href='<?= base_url('medicos/create') ?>'"> Agregar Veterinarios</button>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Lista de Veterinarios</h4>

                                    <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="text-white bg-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>WhatsApp</th>
                                                    <th>Especialidad</th>
                                                    <th>Licencia</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($medicos as $medicos) : ?>
                                                    <tr>
                                                        <td><?= $medicos['id'] ?></td>
                                                        <td><?= $medicos['nombre'] ?></td>
                                                        <td><?= $medicos['apellido'] ?></td>
                                                        <td><?= $medicos['whatsapp'] ?></td>
                                                        <td><?= $medicos['especialidad'] ?></td>
                                                        <td><?= $medicos['licencia'] ?></td>
                                                        <td>

                                                            <form action="<?= base_url('medicos/delete/' . $medicos['id']) ?>" method="post">
                                                                <button type="button" class="btn btn-icon btn-primary btn-rounded mdi mdi-file-check" onclick="location.href='<?= base_url('medicos/editar/' . $medicos['id']) ?>'"></button>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-icon btn-rounded btn-dark mdi mdi-account-remove"></button>
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
                </div>
            </div>
            </div>
            </div>
            <!-- content-wrapper ends -->