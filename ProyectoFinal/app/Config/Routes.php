<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

/* $routes->get('/', 'Productos::index');
$routes->get('productos/create', 'Productos::create');
$routes->post('productos/store', 'Productos::store');
$routes->get('productos/edit/(:num)', 'Productos::edit/$1');
$routes->put('productos/update/(:num)', 'Productos::update/$1');
$routes->delete('productos/delete/(:num)', 'Productos::delete/$1'); */

$routes->get('/', 'Productos::index', ['filter' => 'auth']);
$routes->get('productos/listar', 'Productos::index', ['filter' => 'auth']);
$routes->get('productos/create', 'Productos::create', ['filter' => 'auth']);
$routes->post('productos/store', 'Productos::store', ['filter' => 'auth']);
$routes->get('productos/edit/(:num)', 'Productos::edit/$1', ['filter' => 'auth']);
$routes->put('productos/update/(:num)', 'Productos::update/$1', ['filter' => 'auth']);
$routes->get('productos/disable/(:num)', 'Productos::disable/$1', ['filter' => 'auth']);
$routes->get('productos/enable/(:num)', 'Productos::enable/$1', ['filter' => 'auth']);
$routes->delete('productos/delete/(:num)', 'Productos::delete/$1', ['filter' => 'auth']);
$routes->get('logout', 'Productos::logout', ['filter' => 'auth']);

$routes->get('categoria/listar', 'Categoria::listar', ['filter' => 'auth']);
$routes->get('categoria/create', 'Categoria::create', ['filter' => 'auth']);
$routes->post('categoria/store', 'Categoria::store', ['filter' => 'auth']);
$routes->get('categoria/editar/(:num)', 'Categoria::editar/$1', ['filter' => 'auth']);
$routes->put('categoria/update/(:num)', 'Categoria::update/$1', ['filter' => 'auth']);
$routes->get('categoria/disable/(:num)', 'Categoria::disable/$1', ['filter' => 'auth']);
$routes->get('categoria/enable/(:num)', 'Categoria::enable/$1', ['filter' => 'auth']);
$routes->delete('categoria/delete/(:num)', 'Categoria::delete/$1', ['filter' => 'auth']);

$routes->get('clientes/listar', 'Clientes::listar', ['filter' => 'auth']);
$routes->get('clientes/create', 'Clientes::create', ['filter' => 'auth']);
$routes->post('clientes/store', 'Clientes::store', ['filter' => 'auth']);
$routes->get('clientes/editar/(:num)', 'Clientes::editar/$1', ['filter' => 'auth']);
$routes->put('clientes/update/(:num)', 'Clientes::update/$1', ['filter' => 'auth']);
$routes->delete('clientes/delete/(:num)', 'Clientes::delete/$1', ['filter' => 'auth']);
$routes->post('clientes/buscar', 'Clientes::buscar', ['filter' => 'auth']);

$routes->get('usuarios/listar', 'Usuarios::index', ['filter' => 'auth']);
$routes->get('usuarios/login', 'Usuarios::login');
$routes->post('usuarios/inicioSesion', 'Usuarios::inicioSesion');
$routes->get('usuarios/register', 'Usuarios::register');
$routes->post('usuarios/registro', 'Usuarios::registro');
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1', ['filter' => 'auth']);
$routes->put('usuarios/update/(:num)', 'Usuarios::update/$1', ['filter' => 'auth']);
$routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1', ['filter' => 'auth']);
$routes->get('usuarios/disable/(:num)', 'Usuarios::disable/$1', ['filter' => 'auth']);
$routes->get('usuarios/enable/(:num)', 'Usuarios::enable/$1', ['filter' => 'auth']);
$routes->post('usuarios/verificar', 'Usuarios::verificar');
$routes->get('usuarios/verificar', 'Usuarios::verificarGet');
$routes->get('usuarios/reenviar', 'Usuarios::reenviarCodigo');
$routes->get('usuarios/cambiarContrasena', 'Usuarios::cambiarContrasena', ['filter' => 'auth']);
$routes->post('usuarios/cambiarContrasena', 'Usuarios::cambiarContrasena1', ['filter' => 'auth']);

$routes->get('ventas/index/(:num)', 'Ventas::index/$1', ['filter' => 'auth']);
$routes->post('ventas/crearVenta', 'Ventas::crearVenta', ['filter' => 'auth']);
$routes->get('ventas/listar', 'Ventas::mostrarVentas', ['filter' => 'auth']);
$routes->get('ventas/comprobante/(:num)/(:num)', 'Ventas::generarComprobante/$1/$2', ['filter' => 'auth']);
$routes->post('ventas/buscar', 'Ventas::buscar', ['filter' => 'auth']);
$routes->get('ventas/reportes', 'Reportes::Reportes', ['filter' => 'auth']);
$routes->post('reportes/buscarVentasPorFecha', 'Reportes::buscarVentasPorFecha', ['filter' => 'auth']);

$routes->get('medicos/listar', 'Medicos::listar', ['filter' => 'auth']);
$routes->get('medicos/create', 'Medicos::create', ['filter' => 'auth']);
$routes->post('medicos/store', 'Medicos::store', ['filter' => 'auth']);
$routes->get('medicos/editar/(:num)', 'Medicos::editar/$1', ['filter' => 'auth']);
$routes->put('medicos/update/(:num)', 'Medicos::update/$1', ['filter' => 'auth']);
$routes->delete('medicos/delete/(:num)', 'Medicos::delete/$1', ['filter' => 'auth']);

$routes->get('mascotas/listar', 'Mascotas::listar', ['filter' => 'auth']);
$routes->get('mascotas/create', 'Mascotas::create', ['filter' => 'auth']);
$routes->post('mascotas/store', 'Mascotas::store', ['filter' => 'auth']);
$routes->get('mascotas/editar/(:num)', 'Mascotas::editar/$1', ['filter' => 'auth']);
$routes->put('mascotas/update/(:num)', 'Mascotas::update/$1', ['filter' => 'auth']);
$routes->delete('mascotas/delete/(:num)', 'Mascotas::delete/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
