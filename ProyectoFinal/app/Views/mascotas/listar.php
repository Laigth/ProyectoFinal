            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div>
                            <button class="btn btn-success mdi mdi-library-plus" onclick="location.href='<?= base_url('mascotas/create') ?>'"> Agregar Mascotas</button>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Lista de Mascotas</h4>

                                    <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="text-white bg-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Raza</th>
                                                    <th>fechaRegistro</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($mascotas as $mascotas) : ?>
                                                    <tr>
                                                        <td><?= $mascotas['id'] ?></td>
                                                        <td><?= $mascotas['nombre'] ?></td>
                                                        <td><?= $mascotas['tipo'] ?></td>
                                                        <td><?= $mascotas['raza'] ?></td>
                                                        <td><?= $mascotas['fechaRegistro'] ?></td>
                                                        <td>

                                                            <form action="<?= base_url('mascotas/delete/' . $mascotas['id']) ?>" method="post">
                                                                <button type="button" class="btn btn-icon btn-primary btn-rounded mdi mdi-file-check" onclick="location.href='<?= base_url('mascotas/editar/' . $mascotas['id']) ?>'"></button>
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