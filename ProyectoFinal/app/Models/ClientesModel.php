<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table = 'Clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idUsuarios', 'ciNit', 'razonSocial'];

    public function obtenerClientesPaginados()
    {
        return $this->paginate(10);  // Muestra 10 elementos por página
    }

    public function buscarClientes($ciNit = null)
    {
        if ($ciNit && strlen($ciNit) >= 2) {
            return $this->like('ciNit', $ciNit)->findAll();
        }

        return $this->findAll();
    }
}
