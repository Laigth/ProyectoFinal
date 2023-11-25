<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_usuario', 'correo_electronico', 'whatsapp', 'contrasena', 'tipo_usuario', 'estado', 'codigo_verificacion'];

    public function obtenerUsuarioPorNombreUsuario($nombreUsuario)
    {
        return $this->where('nombre_usuario', $nombreUsuario)->first();
    }
}
