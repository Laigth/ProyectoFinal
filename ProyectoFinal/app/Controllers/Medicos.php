<?php

namespace App\Controllers;

use App\Models\MedicosModel;

class Medicos extends BaseController
{

    public function listar()
    {
        $model = new MedicosModel();
        $data['medicos'] = $model->findAll();
        $data['title'] = 'Inicio';
        echo view('header');
        echo view('medicos/listar', $data);
        echo view('footer');
    }

    public function create()
    {
        $data['title'] = 'Registrar Médico';
        echo view('header');
        echo view('medicos/create', $data);
        echo view('footer');
    }

    public function store()
    {
        $model = new MedicosModel();

        // Asegúrate de que la licencia sea única
        $licenciaExistente = $model->where('Licencia', $this->request->getVar('Licencia'))->first();
        if ($licenciaExistente) {
            // Muestra un mensaje de error y redirige al usuario
            session()->setFlashdata('error', 'El número de licencia ya existe.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'whatsapp' => $this->request->getVar('whatsapp'),
            'especialidad'  => $this->request->getVar('especialidad'),
            'licencia' => $this->request->getVar('licencia'),
        ];

        $model->insert($data);
        return redirect()->to(base_url('medicos/listar'));
    }

    public function editar($id = null)
    {
        $model = new MedicosModel();
        $data['medicos'] = $model->find($id);
        $data['title'] = 'Editar';
        echo view('header');
        echo view('medicos/editar', $data);
        echo view('footer');

    }


    
    public function update($id = null)
    {
        $model = new MedicosModel();

        // Asegúrate de que la licencia sea única
        $licenciaExistente = $model->where('Licencia', $this->request->getVar('Licencia'))->first();
        if ($licenciaExistente && $licenciaExistente['id'] != $id) {
            // Muestra un mensaje de error y redirige al usuario
            session()->setFlashdata('error', 'El número de licencia ya existe.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'whatsapp' => $this->request->getVar('whatsapp'),
            'especialidad'  => $this->request->getVar('especialidad'),
            'licencia' => $this->request->getVar('licencia'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url());
    }
    public function delete($id = null)
    {
        $model = new MedicosModel();
        $model->delete($id);
        return redirect()->to(base_url('medicos/listar'));
    }

    public function logout()
    {
        session()->remove('usuario');
        return redirect()->to(base_url('usuarios/login'));
    }
}
