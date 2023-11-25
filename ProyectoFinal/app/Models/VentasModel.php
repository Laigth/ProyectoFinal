<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'Ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idClientes', 'idUsuarios', 'total', 'fechaRegistro'];

    public function agregarVenta($idCliente, $idUsuario, $totalVenta, $detalle_data)
    {
        // Inicia una transacción en la base de datos
        $this->transStart();

        // Intenta disminuir la cantidad del producto en stock
        $productosModel = new \App\Models\ProductosModel();
        foreach ($detalle_data as &$detalle) {
            $producto = $productosModel->where('nombreP', $detalle['nombre'])->first();
            if ($producto) {
                if (!$productosModel->disminuirCantidad($producto['id'], $detalle['cantidadV'])) {
                    $this->transRollback();
                    return 'Productos insuficientes. La cantidad disponible de ' . $detalle['nombre'] . ' es ' . $producto['stock'];
                }
            }
        }
        

        // Si hay suficiente stock para todos los productos, procede a insertar la venta y los detalles de la venta
        $venta = [
            'idUsuarios' => $idUsuario,
            'idClientes' => $idCliente,
            'total' => $totalVenta,
        ];

        // Inserta la venta y obtiene el ID de la venta insertada
        $this->insert($venta);
        $idVenta = $this->insertID();

        // Inserta los detalles de la venta en la tabla 'DetalleVentas'
        foreach ($detalle_data as &$detalle) {
            // Aquí puedes obtener el idProducto basado en el nombre del producto
            // usando el modelo de productos
            $producto = $productosModel->where('nombreP', $detalle['nombre'])->first();
            if ($producto) {
                // Agrega el idProducto, idVentas y nombre del producto al detalle antes de insertarlo
                $detalle['idProductos'] = $producto['id'];
                $detalle['idVentas'] = $idVenta;
                $detalle['nombre'] = $producto['nombreP'];  // Agrega el nombre del producto

                // Inserta los detalles de la venta en la tabla 'DetalleVentas'
                if (!$this->db->table('DetalleVentas')->insert($detalle)) {
                    // Si hay un error al insertar, realiza un rollback y devuelve false
                    $this->transRollback();
                    return false;
                }
            }
        }

        // Completa la transacción en la base de datos
        if ($this->transComplete()) {
            return true;
        } else {
            return false;
        }
    }


    public function obtenerVentasConClientes($nombreCliente = null)
    {
        $this->select('Ventas.id, Clientes.razonSocial, Ventas.total, Ventas.fechaRegistro, Ventas.idUsuarios')
            ->join('Clientes', 'Ventas.idClientes = Clientes.id');

        if ($nombreCliente && strlen($nombreCliente) >= 2) {
            $this->like('Clientes.razonSocial', $nombreCliente);
        }

        // Añade esta línea para ordenar por ID de venta
        $this->orderBy('Ventas.id', 'ASC');

        return $this->paginate(10);  // Muestra 10 elementos por página
    }


    public function obtenerProductosVendidos($fechaInicio, $fechaFinal)
    {
        // Asegúrate de que las fechas estén en el formato correcto
        $fechaInicio = strtotime($fechaInicio);
        $fechaFinal = strtotime($fechaFinal . ' +1 day');

        $this->select('Productos.nombreP, Productos.precioBase, COUNT(DetalleVentas.idProductos) as totalVendidos, SUM(Productos.precioBase * DetalleVentas.cantidadV) as totalRecaudado')
            ->join('DetalleVentas', 'Ventas.id = DetalleVentas.idVentas')
            ->join('Productos', 'DetalleVentas.idProductos = Productos.id')
            ->where('Ventas.fechaRegistro >=', $fechaInicio)
            ->where('Ventas.fechaRegistro <', $fechaFinal)
            ->groupBy('Productos.id');

        return $this->findAll();
    }
}