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
              <h6 class="font-weight-light" style="text-align: center">Realiza tu cambio de contraseña</h6>
              <div class="card-body"> 
              <?php if(session()->getFlashdata('msg')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
              <?php endif; ?>
                <form class="pt-3" action="<?= base_url('usuarios/cambiarContrasena') ?>" method="post">
                  <div class="form-group">
                    <label for="contrasena_actual">Contraseña Actual:</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" placeholder="Contraseña Actual" name="contrasena_actual" required>
                      <div class="input-group-append">
                        <button type="button" id="togglePassword" class="btn btn-sm btn-secondary input-group-text">
                          <span id="icon" class="mdi mdi-eye"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nueva_contrasena">Contraseña Nueva:</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" placeholder="Nueva Contraseña" name="nueva_contrasena" required>
                      <div class="input-group-append">
                        <button type="button" id="togglePassword" class="btn btn-sm btn-secondary input-group-text">
                          <span id="icon" class="mdi mdi-eye"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="verificar_contrasena">Confirmar Contraseña:</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" id="contrasenaInput" placeholder="Repita su Nueva Contraseña" name="verificar_contrasena" required>
                      <div class="input-group-append">
                        <button type="button" id="togglePassword" class="btn btn-sm btn-secondary input-group-text">
                          <span id="icon" class="mdi mdi-eye"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3; center">
                    <button type="submit" class="btn btn-primary" style="font-family: Forte; display: block; margin: auto">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
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
  <!-- container-scroller -->
  <!-- base:js -->
  <script>
    const togglePasswordButtons = document.querySelectorAll('#togglePassword');
const passwordInputs = document.querySelectorAll('[type="password"]');

togglePasswordButtons.forEach((button, index) => {
  button.addEventListener('click', function() {
    const passwordInput = passwordInputs[index];
    const icon = button.querySelector('#icon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('mdi-eye');
      icon.classList.add('mdi-eye-off');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('mdi-eye-off');
      icon.classList.add('mdi-eye');
    }
  });
});
  </script>
  <script src="<?= base_url('vendors/js/vendor.bundle.base.js') ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url('js/jquery.cookie.js" type="text/javascript') ?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url('js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('js/hoverable-collapse.js') ?>"></script>
  <script src="<?= base_url('js/template.js') ?>"></script>
  <!-- endinject -->
</body>
</html>