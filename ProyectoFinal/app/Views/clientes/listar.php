<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3>Lista de Clientes</h3> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <form action="<?= base_url('clientes/buscar') ?>" method="post" style="display: flex; align-items: stretch;">
                            <input type="text" name="ciNit" class="form-control" placeholder="Ingresa el CI/NIT" style="flex: 3; height: 50px;">
                            <button type="submit" class="btn btn-primary" style="height: 50px;">
                                <i class="mdi mdi-magnify"></i> Buscar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" onclick="location.href='<?= base_url('clientes/create') ?>'">
                            <i class="mdi mdi-account-multiple-plus"></i> Agregar Cliente
                        </button>
                    </div>
                </div>
            </div>
            <?php if (isset($message)) : ?>
                <div class="col-md-12">
                    <p style="font-size: 17px; color: blue; font-family: 'Elephant';"><?= $message ?></p>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nit ó Ci</th>
                            <th>Nombre</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?= $cliente['id'] ?></td>
                                <td><?= $cliente['ciNit'] ?></td>
                                <td><?= $cliente['razonSocial'] ?></td>
                                <td><?= $cliente['fechaRegistro'] ?></td>
                                <td>
                                    <form action="<?= base_url('clientes/delete/' . $cliente['id']) ?>" method="post">
                                        <button type="button" class="btn btn-icon btn-primary btn-rounded mdi mdi-file-check" onclick="location.href='<?= base_url('clientes/editar/' . $cliente['id']) ?>'"></button>
                                        <?php if ($cliente['estado'] == 1) : ?>
                                            <button type="button" class="btn btn-icon btn-rounded btn-danger mdi mdi-delete" onclick="location.href='<?= base_url('clientes/disable/' . $cliente['id']) ?>'"></button>
                                        <?php endif; ?>
                                        <?php if ($cliente['estado'] == 1) : ?>
                                            <button type="button" class="btn btn-icon btn-rounded btn-danger mdi mdi-cart-outline" onclick="location.href='<?= base_url('ventas/index/' . $cliente['id']) ?>'"></button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!$busqueda) : ?>
                <div class="pagination-container">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .pagination li a {
        font-size: 18px;
        /* Ajusta el tamaño de la fuente */
        margin-right: 12px;
        /* Añade margen a la derecha */
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }
</style>