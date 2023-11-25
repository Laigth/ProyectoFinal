<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form class="form-sample" id="form-buscar">
                <h2>Reporte General de las Ventas</h2>&nbsp;

                <p class="card-description">
                    Seleccione las fechas:
                </p>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha Inicial: </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" id="fechaInicio" name="fechaInicio">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha Final: </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" id="fechaFinal" name="fechaFinal">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="container-fluid px-4">
                <button type="button" class="btn btn-info">Buscar</button>
            </div>
            <br>
            <br>
            <div class="table-responsive">
                <table id="tablaProductoFecha" class="table table-striped">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Precio Base</th>
                            <th>Total Vendidos</th>
                            <th>Total Recaudado</th>
                            <!-- Aquí puedes agregar las acciones que necesites -->
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
    document.querySelector('.btn.btn-info').addEventListener('click', function() {
        var fechaInicio = document.querySelector('#fechaInicio').value;
        var fechaFinal = document.querySelector('#fechaFinal').value;

        console.log("Fecha de inicio: " + fechaInicio);
        console.log("Fecha final: " + fechaFinal);

        $.ajax({
            url: '<?php echo base_url(); ?>/reportes/buscarVentasPorFecha',
            type: 'post',
            data: {
                fechaInicio: fechaInicio,
                fechaFinal: fechaFinal
            },
            success: function(response) {
                // Imprime la respuesta en la consola
                console.log(response);

                // Vacía el cuerpo de la tabla
                $('#tablaProductoFecha tbody').empty();

                // Itera sobre los datos de la respuesta
                $.each(response, function(i, venta) {
                    // Crea una nueva fila
                    var newRow = $('<tr>');

                    // Añade las celdas a la fila
                    newRow.append('<td>' + venta.ID + '</td>');
                    newRow.append('<td>' + venta.Producto + '</td>');
                    newRow.append('<td>' + venta.PrecioBase + '</td>');
                    newRow.append('<td>' + venta.TotalVendidos + '</td>');
                    newRow.append('<td>' + venta.TotalRecaudado + '</td>');

                    // Añade la fila al cuerpo de la tabla
                    $('#tablaProductoFecha tbody').append(newRow);
                });
            }
        });
    });
</script>