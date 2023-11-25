<?php

namespace App\Models;

use CodeIgniter\Model;

class MascotasModel extends Model
{
    protected $table = 'Mascotas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idClientes','nombre', 'tipo', 'raza'];
}
