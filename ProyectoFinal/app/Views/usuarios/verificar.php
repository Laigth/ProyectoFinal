<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cambio contraseña</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url('vendors/mdi/css/materialdesignicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/css/vendor.bundle.base.css') ?>">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('images/favicon.png') ?>" />

</head>

<body>
  <div class="container-scroller d-flex">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?= base_url('images/logo.png') ?>" alt="logo" style="display: block; margin: auto">
              </div>
              <h3 style="font-family: Forte; text-align: center;">Veterinaria América</h3>
              <h6 class="font-weight-light" style="text-align: center">Verificar Cuenta</h6>
              <p>Por favor, ingresa el código de verificación que se envio a su respectivo correo electrónico, para poder activar tu cuenta.</p>
              <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                  <?= session()->getFlashdata('error') ?>
                </div>
              <?php endif; ?>
              <form class="pt-3" action="<?= base_url('usuarios/verificar') ?>" method="post">
              
                <div class="form-group">
                  <label for="codigo_verificacion">Código de verificación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-paw text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" name="codigo_verificacion" id=" codigo_verificacion" required placeholder="Ingresa tu codigo único de verificación">
                  </div>
                </div>
                <div class="mt-3; center">
                  <button type="submit" class="btn btn-primary" style="font-family: Forte; display: block; margin: auto">Verificar</button>
                </div>
              </form>
              <div class="mt-3; center">
                <button onclick="location.href='<?= base_url('usuarios/reenviar') ?>'" style="font-family: Forte; display: block; margin: auto">Reenviar código</button>
              </div>

              <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                  <?= session('success') ?>
                </div>
              <?php endif; ?>

              <!-- <button type="submit" class="btn btn-primary btn-block">Request new password</button>
      <p class="mt-3 mb-1">
        <a href="<?= base_url('login.html') ?>">Login</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('register.html') ?>" class="text-center">Register a new membership</a>
      </p> -->
            </div>
            <!-- /.login-card-body -->
          </div>

          <div class="col-lg-6 register-half-bg d-none d-lg-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">AnimalCareSolution; 2023 All rights reserved.</p>
          </div>

        </div>

      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('vendors/js/vendor.bundle.base.js') ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url('js/jquery.cookie.js" type="text/javascript') ?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url('js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('js/hoverable-collapse.js') ?>"></script>
  <script src="<?= base_url('js/template.js') ?>"></script>

</body>

</html>