<?php
if (Session::get('loggedIn') == true) :
    // VERIFICA QUE ESTÉ LOGEADO
    // EN CASO DE QUE SI RENDERIZA TODO EL FOOTER DEL DASHBOARD
?>
    </div>
    <!-- main content area end -->
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo ASSETS_PATH ?>js/popper.min.js"></script>
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

    <?php
    render_resources('js', $this->js);
    ?>
    </body>

    </html>

<?php
else :
    // EN CASO DE QUE NO ESTÉ LOGEADO RENDERIZA EL FOOTER DEL LOGIN
?>

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
    </body>

    </html>
<?php endif;
?>