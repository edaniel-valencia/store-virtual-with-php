</div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->

<footer class="footer">
  &copy; <?php echo date('Y'); ?> Desarrollado por E. Daniel Valencia
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/modernizr.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/detect.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/fastclick.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.slimscroll.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.blockUI.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/waves.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.nicescroll.js"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.scrollTo.min.js"></script>

<!-- App js -->
<script src="<?php echo BASE_URL; ?>public/admin/js/app.js"></script>

<script src="<?php echo BASE_URL; ?>public/js/all.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/sweetalert2.all.min.js"></script>
<script>
  const base_url = '<?php echo BASE_URL; ?>';
</script>
<script type="text/javascript" src="<?php echo BASE_URL . 'public/admin/DataTables/datatables.min.js'; ?>"></script>
<script src="<?php echo asset('public/admin/js/es-ES.js'); ?>"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/toastify-js.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js/custom.js'); ?>"></script>
<script>
  (function () {
    var btn = document.getElementById('admin-theme-toggle');
    var icon = document.getElementById('admin-theme-icon');
    function aplicarIcono() {
      var oscuro = document.documentElement.getAttribute('data-theme') === 'dark';
      if (icon) icon.className = oscuro ? 'fas fa-sun' : 'fas fa-moon';
    }
    aplicarIcono();
    if (btn) {
      btn.addEventListener('click', function () {
        var oscuro = document.documentElement.getAttribute('data-theme') === 'dark';
        if (oscuro) {
          document.documentElement.removeAttribute('data-theme');
          localStorage.setItem('theme', 'light');
        } else {
          document.documentElement.setAttribute('data-theme', 'dark');
          localStorage.setItem('theme', 'dark');
        }
        aplicarIcono();
      });
    }
  })();
</script>
