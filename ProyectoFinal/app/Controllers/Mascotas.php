<?php

namespace App\Controllers;

use App\Models\MascotasModel;

class Mascotas extends BaseController
{

    public function listar()
    {
        $model = new MascotasModel();
        $data['mascotas'] = $model->findAll();
        $data['title'] = 'Inicio';
        echo view('header');
        echo view('mascotas/listar', $data);
        echo view('footer');
    }

    public function create()
    {
        $data['title'] = 'Registrar Mascotas';
        echo view('header');
        echo view('mascotas/create', $data);
        echo view('footer');
    }

    public function store()
    {
        $model = new MascotasModel();
        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'tipo'  => $this->request->getVar('tipo'),
            'raza'=> $this->request->getVar('raza'),
        ];
        $model->insert($data);
        return redirect()->to(base_url('mascotas/listar'));
    }

    public function editar($id = null)
    {
        $model = new MascotasModel();
        $data['mascotas'] = $model->find($id);
        $data['title'] = 'Editar';
        echo view('header');
        echo view('mascotas/editar', $data);
        echo view('footer');
    }



    public function update($id = null)
    {
        $model = new MascotasModel();

        // Asegúrate de que la licencia sea única
        $licenciaExistente = $model->where('Licencia', $this->request->getVar('Licencia'))->first();
        if ($licenciaExistente && $licenciaExistente['id'] != $id) {
            // Muestra un mensaje de error y redirige al usuario
            session()->setFlashdata('error', 'El número de licencia ya existe.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'tipo' => $this->request->getVar('tipo'),
            'raza' => $this->request->getVar('raza'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url());
    }
    public function delete($id = null)
    {
        $model = new MascotasModel();
        $model->delete($id);
        return redirect()->to(base_url('mascotas/listar'));
    }

    public function logout()
    {
        session()->remove('usuario');
        return redirect()->to(base_url('usuarios/login'));
    }
}
