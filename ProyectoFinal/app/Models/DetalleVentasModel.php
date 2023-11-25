<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentasModel extends Model
{
    protected $table = 'DetalleVentas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idVentas','idProductos','cantidadV','precioUnitario','nombre'];
}
