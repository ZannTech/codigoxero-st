<?php
if (Session::get('loggedIn') == true) :
?>
    </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer mt-4">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © CodigoXero</span>
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Distributed By: <b>CodigoXero</b></span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Sistema Tierra - Gestión Territorial</span>
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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="<?php echo ASSETS_PATH ?>js/popper.min.js"></script>

  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="/public/spica/vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/public/spica/js/off-canvas.js"></script>
  <script src="/public/spica/js/hoverable-collapse.js"></script>
  <script src="/public/spica/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="/public/spica/js/dashboard.js"></script>
  <!-- bootstrap 4 js -->
    <script src="<?php echo ASSETS_PATH ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/metisMenu.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script> <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- others plugins -->
    <script src="<?php echo ASSETS_PATH ?>js/plugins.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/filedownload.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/inputmask.js"></script>

    <script src="<?php echo ASSETS_PATH ?>js/scripts.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo URL ?>server/server_config.js"></script>
    <script src="<?php echo URL ?>server/helper_sys.js"></script>
    <script src="<?php echo URL ?>server/app_reqcredentials.js"></script>

    <!-- This is data table -->
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- DataTables buttons scripts -->
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/jszip.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/pdfmake.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/vfs_fonts.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/buttons.html5.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/buttons.print.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>plugins/datatables.net/export/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- CORE SCRIPTS -->

    <!--daterangepicker-->
    <script src="<?php echo ASSETS_PATH ?>js/print.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/dtp.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://kit.fontawesome.com/236f1e99b4.js" crossorigin="anonymous"></script>
    <script src="<?php echo URL ?>server/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    const time = document.querySelector(".clock-container")
    function getCurrentTime () {
      const currentDate = new Date(),
      hours = currentDate.getHours(),
      minutes = formatTime(currentDate.getMinutes()),
      seconds = formatTime(currentDate.getSeconds()),
      formatHours = formatTime(((hours + 11) % 12 + 1)),
      format = (hours < 12) || (hours == 24)  ? 'AM' : 'PM'
      time.innerHTML = `${formatHours}:${minutes}:${seconds} <small>${format}</small>`
    }

    function formatTime (value)  {
      return value < 10 ? `0${value}` : value
    }

setInterval(getCurrentTime, 1000);
</script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- amchart css -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php
    render_resources('js', $this->js);
    ?>
  <!-- End custom js for this page-->
</body>

</html>
<?php else : ?>
    <script src="<?php echo ASSETS_PATH ?>js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/jquery.slicknav.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="<?php echo ASSETS_PATH ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/metisMenu.min.js"></script>
    <!-- others plugins -->
    <script src="<?php echo ASSETS_PATH ?>js/plugins.js"></script>
    <script src="<?php echo ASSETS_PATH ?>js/scripts.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo URL ?>server/server_config.js"></script>


    <!-- CORE SCRIPTS -->
    <?php
    render_resources('js', $this->js);
    ?>
<?php endif; ?>