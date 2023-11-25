<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $model = new UsuariosModel();
        $data['usuarios'] = $model->where('Estado', 1)->findAll();
        $data['usuarios_deshabilitados'] = $model->where('Estado', 0)->findAll();
        $data['title'] = 'Inicio';
        echo view('header');
        echo view('usuarios/listar', $data);
        echo view('footer');
    }

    public function login()
    {
        return view('usuarios/login');
    }

    public function register()
    {
        return view('usuarios/register');
    }

    public function registro()
    {
        // Obtener el modelo de usuarios
        $usuariosModel = new UsuariosModel();

        // Validar los datos del formulario de registro
        $validation =  \Config\Services::validation();
        $validation->setRule('whatsapp', 'whatsapp', 'required|numeric|is_unique[usuarios.whatsapp]', [
            'is_unique' => 'El número de teléfono ya está registrado.'
        ]);
        if (!$this->validate($validation->getRules())) {
            // Los datos de registro no son válidos, mostrar errores de validación
            return view('usuarios/Register', [
                'validation' => $this->validator,
                'nombre_usuario' => $this->request->getPost('nombre_usuario'),
                'correo_electronico' => $this->request->getPost('correo_electronico')
            ]);
        }

        // Obtener los datos del formulario de registro
        $nombreUsuario = $this->request->getPost('nombre_usuario');
        $correoElectronico = $this->request->getPost('correo_electronico');
        $contrasena = (string) $this->request->getPost('contrasena');

        // Generar un código de verificación único y guardarlo en la base de datos junto con la información del usuario
        $codigoVerificacion = mt_rand(10000000, 99999999);
        $datosUsuario = [
            'nombre_usuario' => $nombreUsuario,
            'correo_electronico' => $correoElectronico,
            'whatsapp' => $this->request->getPost('whatsapp'),
            'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT), // Hashear la contraseña para mayor seguridad
            'tipo_usuario' => ($contrasena === 'pet2023') ? 'administrador' : 'empleado',
            'fechaRegistro' => $this->request->getPost('fechaRegistro'), // Asignar el tipo de usuario según la contraseña ingresada
            'codigo_verificacion' => $codigoVerificacion,
            'estado' => 0 // Establecer el valor del campo activo en 0 (inactivo) cuando el usuario se registra
        ];
        $usuariosModel->save($datosUsuario);
        $usuarioId = $usuariosModel->getInsertID();
        session()->set('usuario_id', $usuarioId);

        // Enviar un correo electrónico al usuario con el código de verificación o un enlace que contenga el código
        $email = \Config\Services::email();
        $email->setFrom('condori.raul.800@gmail.com', 'Veterinaria America');
        $email->setTo($correoElectronico);
        $email->setSubject('Verificación de correo electrónico');
        $email->setMessage("Gracias por registrarte en nuestro sitio web. Tu código de verificación es: {$codigoVerificacion}");
        if (!$email->send()) {
            // El correo electrónico no se pudo enviar, mostrar mensaje de error
            return redirect()->back()->withInput()->with('error', 'No se pudo enviar el correo electrónico de verificación. Por favor, inténtelo de nuevo.');
        }
        // Redirigir al usuario a la página donde puede ingresar el código de verificación
        return redirect()->to('usuarios/listar');
    }

    public function inicioSesion()
    {
        // Obtener el modelo de usuarios
        $usuariosModel = new UsuariosModel();

        // Obtener los datos del formulario de inicio de sesión
        $nombreUsuario = $this->request->getPost('nombre_usuario');
        $contrasena = (string) $this->request->getPost('contrasena');

        // Obtener el usuario de la base de datos por nombre de usuario
        $usuario = $usuariosModel->obtenerUsuarioPorNombreUsuario($nombreUsuario);
        if (!$usuario || !password_verify($contrasena, $usuario['contrasena'])) {
            // Las credenciales son inválidas, mostrar mensaje de error
            return redirect()->back()->withInput()->with('error', 'Nombre de usuario o contraseña inválidos. Por favor, inténtelo de nuevo.');
        }

        if ($usuario['estado'] == 0) {
            session()->set('usuario_id', $usuario['id']); // Guardar el usuario_id en la sesión
            return redirect()->to('usuarios/verificar');
        }

        session()->set('usuario', $usuario['id']);
        session()->set('nombre_usuario', $usuario['nombre_usuario']);
        session()->set('tipo_usuario', $usuario['tipo_usuario']);

        echo "<script>localStorage.setItem('idUsuario', '{$usuario['id']}');</script>";

        return redirect()->to('productos/listar');
    }

    public function reenviarCodigo()
    {
        // Obtener el modelo de usuarios
        $usuariosModel = new UsuariosModel();

        // Obtener el usuario actualmente autenticado
        $usuarioId = session()->get('usuario_id');
        $usuario = $usuariosModel->find($usuarioId);

        // Generar un nuevo código de verificación y guardarlo en la base de datos
        $codigoVerificacion = mt_rand(10000000, 99999999);
        $usuariosModel->update($usuarioId, [
            'codigo_verificacion' => $codigoVerificacion
        ]);

        // Enviar un correo electrónico al usuario con el nuevo código de verificación
        $email = \Config\Services::email();
        $email->setFrom('condori.raul.800@gmail.com', 'Veterinaria America');
        $email->setTo($usuario['correo_electronico']);
        $email->setSubject('Verificación de correo electrónico');
        $email->setMessage("Tu nuevo código de verificación es: {$codigoVerificacion}");
        if (!$email->send()) {
            // El correo electrónico no se pudo enviar, mostrar mensaje de error
            return redirect()->back()->withInput()->with('error', 'No se pudo enviar el correo electrónico de verificación. Por favor, inténtelo de nuevo.');
        }

        // Redirigir al usuario a la página donde puede ingresar el nuevo código de verificación
        return redirect()->to('usuarios/verificar')->with('success', 'Se ha enviado un nuevo código de verificación a tu correo electrónico.');
    }

    public function verificar()
    {
        $usuariosModel = new UsuariosModel();
        $codigoVerificacion = $this->request->getPost('codigo_verificacion');
        $usuarioId = session()->get('usuario_id');
        $usuario = $usuariosModel->find($usuarioId);

        if ($codigoVerificacion != $usuario['codigo_verificacion']) {
            return redirect()->back()->withInput()->with('error', 'Código de verificación incorrecto. Por favor, inténtelo de nuevo.');
        }

        $usuariosModel->update($usuarioId, ['estado' => 1]);
        session()->set('usuario', $usuario['id']);
        session()->set('nombre_usuario', $usuario['nombre_usuario']);
        session()->set('tipo_usuario', $usuario['tipo_usuario']);
        session()->remove('usuario');
        session()->remove('nombre_usuario');
        session()->remove('tipo_usuario');

        return redirect()->to('usuarios/login')->with('success', 'Cuenta verificada inicie sesion de nuevo');
    }


    public function verificarGet()
    {
        return view('usuarios/verificar');
    }

    public function cambiarContrasena()
    {
        return view('usuarios/cambiarContrasena');
    }

    public function cambiarContrasena1()
    {
        $usuariosModel = new UsuariosModel();

        // Obtener los datos del formulario de cambio de contraseña
        $contrasenaActual = (string) $this->request->getPost('contrasena_actual');
        $nuevaContrasena = (string) $this->request->getPost('nueva_contrasena');
        $verificacionContrasenaNueva = (string) $this->request->getPost('verificar_contrasena');

        // Obtener el usuario actualmente autenticado
        $usuarioId = session()->get('usuario');
        $usuario = $usuariosModel->find($usuarioId);

        // Verificar si la contraseña actual es correcta
        if (!password_verify($contrasenaActual, $usuario['contrasena'])) {
            // La contraseña actual es incorrecta, mostrar mensaje de error
            return redirect()->back()->withInput()->with('error', 'La contraseña Actual es incorrecta. Por favor, inténtelo de nuevo.');
        }

        // Verificar si la nueva contraseña y su confirmación coinciden
        if ($nuevaContrasena !== $verificacionContrasenaNueva) {
            // Las contraseñas no coinciden, mostrar mensaje de error
            return redirect()->back()->withInput()->with('error', 'La nueva contraseña y su verificacion no coinciden. Por favor, inténtelo de nuevo.');
        }

        // Actualizar la contraseña del usuario en la base de datos
        $usuariosModel->update($usuarioId, [
            'contrasena' => password_hash($nuevaContrasena, PASSWORD_DEFAULT)
        ]);

        // Cerrar la sesión del usuario
        session()->remove('usuario');
        session()->remove('nombre_usuario');
        session()->remove('tipo_usuario');

        // Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
        return redirect()->to('usuarios/login')->with('success', 'La contraseña ha sido cambiada exitosamente. Por favor, inicie sesión de nuevo.');
    }

    public function disable($id = null)
    {
        $model = new UsuariosModel();
        $data = [
            'estado' => 0, // Establece el estado como deshabilitado (0)
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('usuarios/listar'));
    }

    public function enable($id = null)
    {
        $model = new UsuariosModel();
        $data = [
            'estado' => 1, // Establece el estado como activo (1)
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('usuarios/listar'));
    }

    public function delete($id = null)
    {
        $model = new UsuariosModel();
        $model->delete($id);
        return redirect()->to(base_url('usuarios/listar'));
    }

    public function editar($id = null)
    {
        $model = new UsuariosModel();
        $data['usuarios'] = $model->find($id);
        $data['title'] = 'Editar';
        echo view('header');
        echo view('usuarios/editar', $data);
        echo view('footer');
    }


    public function update($id = null)
    {
        $model = new UsuariosModel();
        $data = [
            'nombre_usuario'  => $this->request->getVar('nombre_usuario'),
            'correo_electronico'  => $this->request->getVar('correo_electronico'),
            'whatsapp' => $this->request->getVar('whatsapp'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('usuarios/listar'));
    }
}
