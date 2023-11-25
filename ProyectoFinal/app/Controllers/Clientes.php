<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Clientes extends BaseController
{
    public function listar()
    {
        $model = new ClientesModel();

        // Obtiene los datos paginados
        $data['clientes'] = $model->obtenerClientesPaginados();
        $data['pager'] = $model->pager;
        $data['busqueda'] = false; // Indica que no se está realizando una búsqueda

        $data['title'] = 'Inicio';
        echo view('header');
        echo view('clientes/listar', $data);
        echo view('footer');
    }


    public function create()
    {
        $data['title'] = 'Insertar';
        echo view('header');
        echo view('clientes/create', $data);
        echo view('footer');
    }

    public function store()
    {
        $model = new ClientesModel();
        $session = session();
        $idUsuarios = $session->get('usuario'); // obtén 'usuario' en lugar de 'idUsuarios'

        $data = [
            'idUsuarios' => $idUsuarios,
            'ciNit' => $this->request->getVar('ciNit'),
            'razonSocial'  => $this->request->getVar('razonSocial'),
        ];
        $model->insert($data);
        return redirect()->to(base_url('clientes/listar'))->with('success', '');
    }



    public function editar($id = null)
    {
        $model = new ClientesModel();
        $data['clientes'] = $model->find($id);
        $data['title'] = 'Editar';
        echo view('header');
        echo view('clientes/editar', $data);
        echo view('footer');
    }


    public function update($id = null)
    {
        $model = new ClientesModel();
        $data = [
            'ciNit' => $this->request->getVar('ciNit'),
            'razonSocial'  => $this->request->getVar('razonSocial'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('clientes/listar'));
    }

    public function delete($id = null)
    {
        $model = new ClientesModel();
        $model->delete($id);
        return redirect()->to(base_url('clientes/listar'));
    }

    public function logout()
    {
        session()->remove('usuario');
        return redirect()->to(base_url('usuarios/login'));
    }

    public function buscar()
    {
        $model = new ClientesModel();
        $ciNit = $this->request->getVar('ciNit'); // obtén el CI/NIT del formulario de búsqueda

        if (strlen($ciNit) < 2) {
            $data['message'] = "Por favor, ingrese al menos 2 caracteres para la búsqueda.";
            $data['clientes'] = $model->obtenerClientesPaginados();
        } else {
            $data['clientes'] = $model->buscarClientes($ciNit);
        }

        $data['busqueda'] = true; // Indica que se está realizando una búsqueda

        echo view('header');
        echo view('clientes/listar', $data); // muestra los datos del cliente en la tabla
        echo view('footer');
    }
}
