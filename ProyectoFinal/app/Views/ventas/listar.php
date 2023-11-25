<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3>Lista de ventas</h3>&nbsp;
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <form action="<?= base_url('ventas/buscar') ?>" method="post" style="display: flex; align-items: stretch;">
                            <input type="text" name="nombreCliente" class="form-control" placeholder="Ingresa el nombre del cliente" style="flex: 3; height: 50px;">
                            <button type="submit" class="btn btn-primary" style="height: 50px;">
                                <i class="mdi mdi-magnify"></i> Buscar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (isset($message)) : ?>
                <div class="col-md-12">
                    <p style="font-size: 17px; color: blue; font-family: 'Elephant';"><?= $message ?></p>
                </div>
            <?php endif; ?>

            <!-- <p class="card-description">
            Add class <code>.table-striped</code>
          </p> -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Fecha Registro</th>
                            <th>Comprobantes</th>
                            <!-- Aquí puedes agregar las acciones que necesites -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $venta) : ?>
                            <tr>
                                <td><?= $venta['id'] ?></td>
                                <td><?= $venta['razonSocial'] ?></td>
                                <td><?= $venta['total'] ?></td>
                                <td><?= $venta['fechaRegistro'] ?></td>
                                <td>
                                    <button class="btn btn-icon btn-rounded btn-primary mdi mdi-square-inc-cash" onclick="window.open('<?= base_url() ?>/ventas/comprobante/<?= $venta['id'] ?>/<?= $venta['idUsuarios'] ?>', '_blank')"></button>
                                </td>
                                <!-- Aquí puedes agregar las acciones que necesites -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<style>
    .pagination li a {
        font-size: 15px;
        /* Ajusta el tamaño de la fuente */
        margin-right: 12px;
        /* Añade margen a la derecha */
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }
</style>