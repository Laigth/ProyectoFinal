<style>
    #bg {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
        /* Esto coloca la imagen detrás del contenido */
    }

    .card-body {
        background-image: url('<?= base_url('images/imagenes/fondo-form.jpg') ?>');
        background-size: cover;
        /* Esto hará que la imagen de fondo cubra todo el elemento */
        background-position: center;
        /* Esto centrará la imagen de fondo */
    }
</style>
</div>
</div>
<!-- partial:../../partials/_footer.html -->
<footer class="footer">
  <div class="card">
    <div class="card-body">
      <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="<?= base_url('https://www.bootstrapdash.com/" target="_blank') ?>">bootstrapdash.com </a>2023</span>
      </div>
    </div>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<!-- ... -->
<!-- ... -->
<script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url(); ?>/js/off-canvas.js"></script>
<script src="<?php echo base_url(); ?>/js/hoverable-collapse.js"></script>
<script src="<?php echo base_url(); ?>/umd/simple-datatables.min.js"></script>
<script src="<?php echo base_url(); ?>/js/datatables-simple-demo.js"></script>
<script src="<?php echo base_url(); ?>/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>/js/template.js"></script>
<!-- ... -->
</body>
</html>
