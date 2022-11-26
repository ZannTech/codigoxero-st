<?php
if (Session::get('loggedIn') == true) :
?>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        var hostUrl = "<?php echo URL ?>public/assetsv2/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="<?php echo URL ?>public/assetsv2/plugins/global/plugins.bundle.js"></script>
    
    <script src="<?php echo URL ?>public/assetsv2/js/scripts.bundle.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

    <script>$.fn.selectpicker.Constructor.BootstrapVersion = '5';
</script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="<?php echo URL ?>public/assetsv2/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
 
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="<?php echo URL ?>public/assetsv2/js/widgets.bundle.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/widgets.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/apps/chat/chat.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/utilities/modals/create-app.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/utilities/modals/new-target.js"></script>
    <script src="<?php echo URL ?>public/assetsv2/js/custom/utilities/modals/users-search.js"></script>

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
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    </body>
    <!--end::Body-->

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