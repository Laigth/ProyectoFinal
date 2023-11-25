<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productos extends BaseController
{


    public function index()
    {
        $model = new ProductosModel();
        $data['productos'] = $model->where('Estado', 1)->findAll();
        $data['productos_deshabilitados'] = $model->where('Estado', 0)->findAll();
        $data['title'] = 'Inicio';
        echo view('header');
        echo view('productos/listar', $data);
        echo view('footer');
    }

    public function create()
    {
        $model = new ProductosModel();
        $data['categorias'] = $model->getCategorias();
        $data['title'] = 'Insertar';
        echo view('header');
        echo view('productos/create', $data);
        echo view('footer');
    }

    public function store()
    {
        $model = new ProductosModel();
        $image = $this->request->getFile('imagen');
        if ($image->isValid() && !$image->hasMoved()) {
            $image->move('./uploads/');
            $data = [
                'nombreP' => $this->request->getVar('nombreP'),
                'precioBase'  => $this->request->getVar('precioBase'),
                'stock' => $this->request->getVar('stock'),
                'estado' => 1, // Establece el estado como activo (1)
                'imagen' => $image->getName(),
                'idCategoria' => $this->request->getVar('categoria'),
                'fechaRegistro' => $this->request->getVar('fechaRegistro'), // Almacena la fecha seleccionada
            ];
            $model->insert($data);
        }
        return redirect()->to(base_url('productos/listar'));
    }

    public function edit($id = null)
    {
        $model = new ProductosModel();
        $data['categorias'] = $model->getCategorias();
        $data['producto'] = $model->find($id);
        $data['title'] = 'Editar';
        echo view('header');
        echo view('productos/edit', $data);
        echo view('footer');
    }

    public function update($id = null)
    {
        $model = new ProductosModel();
        $image = $this->request->getFile('imagen');
        if ($image->isValid() && !$image->hasMoved()) {
            $image->move('./uploads/');
            $data = [
                'nombreP' => $this->request->getVar('nombreP'),
                'precioBase'  => $this->request->getVar('precioBase'),
                'stock' => $this->request->getVar('stock'),
                'imagen' => $image->getName(),
                'idCategoria' => $this->request->getVar('categoria'),
            ];
            $model->update($id, $data);
        }
        return redirect()->to(base_url('productos/listar'));
    }

    public function disable($id = null)
    {
        $model = new ProductosModel();
        $data = [
            'estado' => 0, // Establece el estado como deshabilitado (0)
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('productos/listar'));
    }

    public function enable($id = null)
    {
        $model = new ProductosModel();
        $data = [
            'estado' => 1, // Establece el estado como activo (1)
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('productos/listar'));
    }


    public function delete($id = null)
    {
        $model = new ProductosModel();
        $model->delete($id);
        return redirect()->to(base_url());
    }

    public function logout()
    {
        session()->remove('usuario');
        return redirect()->to(base_url());
    }
}
