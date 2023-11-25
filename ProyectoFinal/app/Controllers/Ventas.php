<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Models\ClientesModel;
use App\Models\UsuariosModel;

use FPDF;

require_once APPPATH . '/Libraries/fpdf/fpdf.php';

class Ventas extends BaseController
{
    protected $request;

    public function index($idCliente)
    {
        $productosModel = new ProductosModel();
        $clientesModel = new ClientesModel();

        // Obtiene todos los productos
        $data['productos'] = $productosModel->findAll();

        // Obtiene los datos del cliente
        $data['cliente'] = $clientesModel->find($idCliente);

        echo view('header');
        // Carga la vista de ventas.
        echo view('ventas/index', $data);

        echo view('footer');
    }

    public function crearVenta()
    {
        // Obtiene los datos del carrito del formulario
        $carritoData = $this->request->getPost('carrito');
        $totalVenta = $this->request->getPost('totalVenta');

        // Crea la venta con los datos del carrito
        $ventasModel = new VentasModel();
        $idCliente = $this->request->getPost('idCliente');
        $idUsuario = session()->get('usuario');

        if ($ventasModel->agregarVenta($idCliente, $idUsuario, $totalVenta, $carritoData)) {
            // Obtener el ID de la última venta insertada
            $idVenta = $ventasModel->getInsertID();

            // Devuelve la URL del PDF
            echo base_url('ventas/comprobante/' . $idVenta . '/' . $idUsuario);
        } else {
            // Devuelve un mensaje de error
            echo 'Error';
        }

        exit();
    }

    public function mostrarVentas()
    {
        $ventasModel = new VentasModel();

        $elementosPorPagina = 10;
        $totalElementos = $ventasModel->countAllResults();

        if ($totalElementos <= $elementosPorPagina) {
            // Si hay menos elementos que la cantidad por página, obtén todos los elementos
            $data['ventas'] = $ventasModel->findAll();
        } else {
            // Si hay más elementos que la cantidad por página, usa paginate()
            $data['ventas'] = $ventasModel->obtenerVentasConClientes();
        }

        // Configura el paginador
        $data['pager'] = $ventasModel->pager;

        echo view('header');
        // Carga la nueva vista de ventas.
        echo view('ventas/listar', $data);

        echo view('footer');
    }


    public function buscar()
    {
        $model = new VentasModel();
        $nombreCliente = $this->request->getVar('nombreCliente');

        $elementosPorPagina = 10;
        $totalElementos = $model->countAllResults();

        if ($totalElementos <= $elementosPorPagina) {
            // Si hay menos elementos que la cantidad por página, obtén todos los elementos
            $data['ventas'] = $model->findAll();
        } else {
            // Si hay más elementos que la cantidad por página, usa paginate()
            $data['ventas'] = $model->obtenerVentasConClientes($nombreCliente);
        }

        // Configura el paginador
        $data['pager'] = $model->pager;

        echo view('header');
        echo view('ventas/listar', $data);
        echo view('footer');
    }


    public function generarComprobante($idVenta, $idUsuario)
    {
        $ventasModel = new VentasModel();
        $usuariosModel = new UsuariosModel();
        // Realizar la consulta para obtener el último ID
        $venta = $ventasModel->find($idVenta);
        $usuario = $usuariosModel->find($idUsuario);
        $usuario = $usuariosModel->find($idUsuario);
        //PROCESO DE GENERAR LITERALMENTE EL NUMERO TOTAL DE LA VENTA ACTUAL
        $numero = $venta['total'];
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $palabras = $fmt->format($numero);

        //PROCESO DE GENERAR EL PDF EN CON LOS VALORES DE LA VENTA ACTUAL
        $db = \Config\Database::connect();
        $builder = $db->table('detalleVentas');
        $builder->select('ventas.id');
        $builder->select('clientes.ciNit');
        $builder->select('clientes.razonSocial');
        $builder->select('ventas.fechaRegistro');
        $builder->select('detalleventas.cantidadV');
        $builder->select('productos.nombreP');
        $builder->select('productos.precioBase');
        $builder->select('detalleventas.precioUnitario');
        $builder->select('ventas.total');
        $builder->select('usuarios.nombre_Usuario');

        $builder->join('ventas', 'ventas.id = detalleventas.idVentas');
        $builder->join('productos', 'productos.id = detalleventas.idProductos');
        $builder->join('clientes', 'clientes.id = ventas.idClientes');
        $builder->join('usuarios', 'usuarios.id = ventas.idUsuarios');

        $builder->where('ventas.id', $venta['id']);
        $ventas = $builder->get();
        $data = $ventas->getResult();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image(base_url() . '/images/fondo-Comprobante.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
        $pdf->AddFont('Ennobled', '', 'Ennobled-Pet.php');
        $pdf->AddFont('Stinky', '', 'Stinky-Pete-Trial.php');
        $pdf->AddFont('Another', '', 'Another Danger Slanted - Demo.php');
        $pdf->SetFont('Arial', 'B', 15);
        //$pdf->Line(11, 130, 197, 130);
        // $pdf->Line(11, 160, 60, 160);
        // $pdf->Line(120, 160, 200, 160);
        // $pdf->Line(11, 190, 199, 190);
        $pdf->Cell(10, 10, $pdf->Image(base_url() . '/images/logo.png', 10, 20, 50), 0, 0, 'C');
        $pdf->Cell(65, 15, "");
        $pdf->Cell(80, 10, "");
        $pdf->Cell(10, 10, "Nro: 0000" . $venta['id']);
        $pdf->Cell(70, 10, "");
        $pdf->Ln(20);
        $pdf->Cell(45, 10, "");
        $pdf->SetFont("Ennobled", "", 35);
        $pdf->Cell(10, 30, "VETERINARIA");
        $pdf->Ln(12);
        $pdf->Cell(70, 10, "");
        $pdf->Cell(10, 30, "AMERICA");
        $pdf->Ln(30);
        $pdf->Cell(40, 10, "");
        $pdf->SetFont("Stinky", "", 20);
        $pdf->Cell(80, 10, "COMPROBANTE DE VENTA");
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Ln(15);
        $pdf->Cell(190, 20, "", 0);
        $pdf->Ln(10);
        foreach ($data as $venta) {
            $fecha = date('d/m/Y', strtotime($venta->fechaRegistro));
            $pdf->Cell(70, 0, "CLIENTE: " . strtoupper($venta->razonSocial));
            $pdf->Cell(70, 0, "C.I. " . $venta->ciNit);
            //$pdf->Cell(70, 0, "FECHA: " . date('d/m/Y'));
            $pdf->Cell(70, 0, "FECHA: " . $fecha);
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(10);
        $pdf->SetFillColor(0, 0, 255);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(70, 10, 'PRODUCTO', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'CANTIDAD', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'PRECIO', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'SUBTOTAL', 1, 0, 'C', true);
        $pdf->SetTextColor(0, 0, 0);
        foreach ($data as $detalle) {
            $subtotal = $detalle->precioUnitario * $detalle->cantidadV;
            $pdf->Ln(10);
            $pdf->Cell(70, 10, $detalle->nombreP, 1);
            $pdf->Cell(40, 10, $detalle->cantidadV, 1, 0, 'C');
            $pdf->Cell(40, 10, $detalle->precioBase, 1, 0, 'C');
            $pdf->Cell(40, 10, $subtotal, 1, 0, 'C');
        }

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Ln(25);
        $pdf->Cell(85, 10, "TRATANTE: " . strtoupper($usuario['nombre_usuario']));
        $pdf->Cell(10, 40, "");
        $pdf->Cell(16, 10, "");

        $pdf->Cell(80, 10, "TOTAL A PAGAR Bs. " . $detalle->total);

        $pdf->Ln(30);
        $pdf->Cell(150, 10, "SON: " . $palabras . " 00/100 bolivianos");
        $pdf->Ln(30);
        $pdf->SetFont("times", "B", 15);
        $pdf->Cell(0, 10, "UNA VEZ REALIZADA LA COMPRA NO SE ACEPTAN DEVOLUCIONES", 0, 1, 'C');
        $pdf->Cell(10, 10, "");
        $pdf->Cell(16, 10, "");
        $pdf->Ln(10);
        $pdf->Cell(10, 10, "");
        $pdf->Cell(0, 10, "Gracias  por su preferencia!!", 0, 1, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Output('Comprobante.pdf', 'I'); // 'I' para mostrar en el navegador

        exit();
    }
}
