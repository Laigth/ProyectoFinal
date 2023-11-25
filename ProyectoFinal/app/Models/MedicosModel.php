<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicosModel extends Model
{
    protected $table = 'Medicos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'apellido', 'whatsapp', 'especialidad', 'licencia'];
}
