<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Productos</title>
    <!-- base:css -->
    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/images/favicon.png">

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/all.js"></script>

</head>

<body>
    <div class="container-scroller d-flex">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">

                <li class="nav-item sidebar-category">
                    <p>Acceso a Información Institucional</p>
                    <span></span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('clientes/listar') ?>">
                        <i class="mdi mdi-clipboard-account menu-icon"></i>
                        <span class="menu-title">Clientes</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('mascotas/listar') ?>">
                        <i class="mdi mdi-cat menu-icon"></i>
                        <span class="menu-title">Mascotas</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('medicos/listar') ?>">
                        <i class="mdi mdi-heart-pulse menu-icon"></i>
                        <span class="menu-title">Doctores</span>
                    </a>
                </li> -->

                <li class="nav-item sidebar-category">
                    <p>Información Productos</p>
                    <span></span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('categoria/listar') ?>">
                        <i class="mdi mdi-database menu-icon"></i>
                        <span class="menu-title">Categorias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('productos/listar') ?>">
                        <i class="mdi mdi-food menu-icon"></i>
                        <span class="menu-title">Productos</span>
                    </a>
                </li>

                <li class="nav-item sidebar-category">
                    <p>Gestiones</p>
                    <span></span>
                </li>

                <?php if (session()->has('usuario')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('ventas/listar') ?>">
                            <i class="mdi mdi mdi-cart menu-icon"></i>
                            <span class="menu-title">Comprobante Venta</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session()->has('usuario')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('ventas/reportes') ?>">
                            <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                            <span class="menu-title">Reporte General</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item sidebar-category">
                    <p>Configuraciones del Sistema</p>
                    <span></span>
                </li>

                <?php if (session()->get('tipo_usuario') == 'administrador') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('usuarios/listar') ?>">
                            <i class="mdi mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Usuarios</span>
                        </a>
                    </li>
                <?php endif; ?>


                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('usuarios/login') ?>">
                        <i class="mdi mdi-account-star menu-icon"></i>
                        <span class="menu-title">Iniciar sesión</span>
                    </a>
                </li>

                <?php if (session()->has('usuario')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('usuarios/cambiarContrasena') ?>">
                            <i class="mdi mdi-lock-outline menu-icon"></i>
                            <span class="menu-title">Cambiar contraseña</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session()->has('usuario')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">
                            <i class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Cerrar sesión</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <div class="navbar-brand-wrapper">
                        <a class="navbar-brand brand-logo" href="<?= base_url() ?>"><img src="<?= base_url('images/logo.png') ?>" height="200px" width="x" alt="logo" /></a>
                        <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img src="<?= base_url('images/logo.png') ?>" height="100px" width="100px" alt="logo" /></a>
                    </div>

                    <ul class="navbar-nav navbar-nav-right">


                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>

            </nav>