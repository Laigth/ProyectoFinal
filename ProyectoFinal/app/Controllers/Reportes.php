<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;

class Reportes extends BaseController
{
    public function reportes()
    {
        echo view('header');
        echo view('ventas/reportes');  // No necesitas pasar datos a la vista aquí
        echo view('footer');
    }

    public function buscarVentasPorFecha()
    {
        // Obtiene las fechas de los datos POST
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');

        // Valida las fechas
        if (!$fechaInicio || !$fechaFinal) {
            return $this->response->setStatusCode(400, 'Bad Request');
        }

        // Usa las fechas en tu modelo
        $ventasModel = new VentasModel();
        $ventas = $ventasModel->obtenerProductosVendidos($fechaInicio, $fechaFinal);

        // Devuelve el resultado como una respuesta JSON
        return $this->response->setJSON($ventas);
    }
}
