<?php


namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'Categoria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'descripcion', 'estado'];

    public function obtenerCategoriasPaginadas()
    {
        return $this->paginate(10, 'group1');  // Muestra 10 elementos por página
    }
}
