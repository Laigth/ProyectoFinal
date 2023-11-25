<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'Productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombreP', 'precioBase', 'stock', 'estado', 'imagen', 'idCategoria', 'fechaRegistro'];

    public function getNombreCategoria()
    {
        return $this->db->table('Productos p')
            ->select('p.nombreP, p.precioBase, p.stock, p.estado, p.imagen, c.nombre as nombreCategoria, p.fechaRegistro')
            ->join('categoria c', 'p.idCategoria = c.id')
            ->get()
            ->getResult();
    }

    public function getCategorias()
    {
        return $this->db->table('categoria')->get()->getResult();
    }

    public function disminuirCantidad($idProducto, $cantidad)
    {
        $producto = $this->find($idProducto);

        if ($producto['stock'] < $cantidad) {
            return false; // No hay suficiente stock
        }

        $producto['stock'] -= $cantidad;
        $this->update($idProducto, $producto);

        return true; // Stock suficiente, la cantidad se disminuyó
    }
}
