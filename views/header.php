<?php

if (Session::get('loggedIn') == true):
    // VERIFICA QUE ESTÉ LOGEADO
    // EN CASO DE QUE SI RENDERIZA TODO EL HEADER DEL DASHBOARD
?>
    <!doctype html>
    <html class="no-js" lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            <?php echo dynamic_page_title($_REQUEST['url']); ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo URL ?>favicon.ico">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/themify-icons.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/metisMenu.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/slicknav.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- amchart css -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
        <!-- others css -->
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/typography.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/default-css.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/responsive.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/print.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/dtp.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>zmdi/css/material-design-iconic-font.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link href="<?php echo ASSETS_PATH; ?>plugins/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.12.0/css/ol.css" type="text/css">
        <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.12.0/build/ol.js"></script>
        <!--daterangepicker-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.8.0/proj4.js" integrity="sha512-ha3Is9IgbEyIInSb+4S6IlEwpimz00N5J/dVLQFKhePkZ/HywIbxLeEu5w+hRjVBpbujTogNyT311tluwemy9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo ASSETS_PATH ?>js/leaft.heat.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


        <style>
            .map {
                height: 400px;
                width: 100%;
            }
            
      /** mixins **/
/** mixins end **/
html {
    box-sizing: border-box;
    height: 100%;
  }
  
  *,
  *:before,
  *:after {
    box-sizing: inherit;
  }

  .page {
    width: 100%;
    height: 100%;
  }
  
  .phone {
    width: 100%;
    height: 100%;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: auto 800px;
  }
  
  .chat-root {
    height: 100%;
  }
  
  .wa-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: relative;
  }
  .wa-container .status-bar {
    height: 25px;
    background: #054d44;
    color: #fff;
    font-size: 14px;
    padding: 0 8px;
  }
  .wa-container .status-bar:after {
    content: "";
    display: table;
    clear: both;
  }
  .wa-container .status-bar div {
    float: right;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    margin: 0 0 0 8px;
  }
  .wa-container .user-bar {
    height: 55px;
    background: #075e54;
    color: #fff;
    padding: 0 8px;
    font-size: 24px;
  }
  .wa-container .user-bar:after {
    content: "";
    display: table;
    clear: both;
  }
  .wa-container .user-bar div {
    float: left;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }
  .wa-container .user-bar div.actions {
    float: right;
    margin: 0 0 0 20px;
  }
  .wa-container .user-bar div.actions.more {
    margin: 0 12px 0 20px;
  }
  .wa-container .user-bar div.actions.attachment i {
    display: block;
    transform: rotate(-45deg);
  }
  .wa-container .user-bar .user {
    margin: 0 0 0 8px;
    width: 36px;
    height: 36px;
  }
  .wa-container .user-bar .user img {
    border-radius: 50%;
    display: block;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
    width: 100%;
  }
  .wa-container .user-bar .user-name {
    font-size: 16px;
    margin: 0 0 0 8px;
    width: 165px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .wa-container .user-bar .user-name span {
    display: block;
    font-size: 12px;
  }
  .wa-container .bottom-bar {
    height: 47px;
    background: #000;
    color: #fff;
    font-size: 22px;
  }
  .wa-container .bottom-bar div {
    width: 33.333333%;
    float: left;
    text-align: center;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }
  .wa-container .bottom-bar div.triangle i {
    display: block;
    transform: rotate(-90deg);
  }
  .wa-container .chat-window {
    height: calc(100% - 152px);
    position: relative;
    background: url("http://valeriopierbattista.com/projects/wutsapp/images/dist/wall.jpg");
    background-size: 100%;
    box-shadow: inset 0 10px 10px -10px #000000;
  }
  .wa-container .chat-window:after {
    content: "";
    display: table;
    clear: both;
  }
  .wa-container .chat-window .conversation {
    width: 100%;
    overflow: auto;
    height: calc(100% - 68px);
    padding: 0 16px;
  }
  .wa-container .chat-window .conversation:after {
    content: "";
    display: table;
    clear: both;
  }
  .wa-container .chat-window .balloon {
    padding: 8px;
    position: relative;
    color: #000;
    font-size: 14px;
    line-height: 18px;
    box-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
    clear: both;
    margin: 8px 0;
    max-width: 85%;
  }
  .wa-container .chat-window .balloon:after {
    position: absolute;
    content: "";
    width: 0;
    height: 0;
    border-style: solid;
  }
  .wa-container .chat-window .balloon .data {
    display: inline-block;
    padding: 0 20px 0 16px;
    font-size: 11px;
    color: #b9b9b9;
    position: relative;
    bottom: -5px;
    float: right;
    background-repeat: no-repeat;
    background-position: right 3px;
    background-color: transparent;
    background-size: 16px auto;
  }
  .wa-container .chat-window .balloon .data.blue {
    background-image: url("http://wutsapp.net/images/dist/blue.png");
  }
  .wa-container .chat-window .balloon img {
    width: 100%;
  }
  .wa-container .chat-window .balloon:first-child {
    margin: 16px 0 8px;
  }
  .wa-container .chat-window .balloon.him {
    background: #fff;
    float: left;
    border-radius: 0px 5px 5px 5px;
  }
  .wa-container .chat-window .balloon.him .data {
    padding: 0 0 0 16px;
  }
  .wa-container .chat-window .balloon.him:after {
    top: 0;
    left: -10px;
    border-width: 0px 10px 10px 0;
    border-color: transparent #fff transparent transparent;
  }
  .wa-container .chat-window .balloon.you {
    background: #e1ffc7;
    float: right;
    border-radius: 5px 0px 5px 5px;
  }
  .wa-container .chat-window .balloon.you:after {
    top: 0;
    right: -10px;
    border-width: 0px 0 10px 10px;
    border-color: transparent transparent transparent #e1ffc7;
  }
  .wa-container .chat-window .textarea {
    width: 100%;
    z-index: 2;
    left: 0;
    position: absolute;
    bottom: 8px;
    height: 50px;
    padding: 0 0 0 8px;
  }
  .wa-container .chat-window .textarea:after {
    content: "";
    display: table;
    clear: both;
  }
  .wa-container .chat-window .textarea ::-webkit-input-placeholder {
    color: #b9b9b9;
  }
  .wa-container .chat-window .textarea ::-moz-placeholder {
    /* Firefox 19+ */
    color: #b9b9b9;
  }
  .wa-container .chat-window .textarea :-ms-input-placeholder {
    color: #b9b9b9;
  }
  .wa-container .chat-window .textarea div,
  .wa-container .chat-window .textarea textarea {
    height: 100%;
    float: left;
    background: #fff;
  }
  .wa-container .chat-window .textarea .emoticons {
    width: 10%;
    background: url("http://valeriopierbattista.com/projects/wutsapp/images/dist/smile.png") center center no-repeat #fff;
    background-size: 20px;
    border-radius: 5px 0 0 5px;
  }
  .wa-container .chat-window .textarea textarea {
    width: 63%;
    border: 0;
    outline: none;
    padding-top: 14px;
    resize: none;
  }
  .wa-container .chat-window .textarea .photo {
    width: 10%;
    border-radius: 0 0 5px 0;
    position: relative;
    text-align: center;
  }
  .wa-container .chat-window .textarea .photo:after {
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    content: "";
    top: 0;
    right: -10px;
    border-width: 0px 0 10px 10px;
    border-color: transparent transparent transparent #fff;
  }
  .wa-container .chat-window .textarea .photo i {
    display: block;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #7d8488;
    font-size: 24px;
  }
  .wa-container .chat-window .textarea .send-mic {
    width: 17%;
    background: transparent;
    position: relative;
    cursor: pointer;
  }
  .wa-container .chat-window .textarea .send-mic .circle-cont {
    color: #fff;
    border-radius: 50%;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #00897b;
    width: 48px;
    height: 48px;
    box-shadow: 0 1px 0 #00564d;
  }
  .wa-container .chat-window .textarea .send-mic .circle-cont i {
    display: inline-block;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 24px;
  }
  
  .wrapperchat {
    height: calc(100% - 81px);
  }
  
  .page.nexus6 .phone {
    background-image: url("http://valeriopierbattista.com/projects/wutsapp/images/dist/nexus6.png");
    background-size: auto 799px;
  }
  .page.nexus6 .wa-container {
    width: 382px;
    height: 681px;
    padding: 6px 0 0;
  }
  .page.nexus6 .wa-container .chat-window {
    height: calc(100% - 55px);
  }
  .page.nexus6 .wrapperchat {
    height: calc(100% - 69px);
  }
  
  .more {
    position: absolute;
    bottom: 30px;
    left: 10px;
  }
  .more a,
  .more a:visited {
    padding: 10px 20px;
    color: black;
    font-size: 24px;
    background: yellow;
  }

  
  

  
        </style>
        <!-- CORE CSS -->
        <?php
        render_resources('css', $this->css);
        ?>
        <!-- modernizr css -->
        <script src="<?php echo ASSETS_PATH ?>js/vendor/modernizr-2.8.3.min.js"></script>
       
        <style>
            body.swal2-shown>[aria-hidden=true] {
                transition: .1s filter;
                filter: blur(10px) grayscale(90%)
            }
        </style>
    </head>
    <noscript>
        javascript error, please enable JavaScript for loading this paage
    </noscript>

    <!--Sys Helpers--> 
    <input type="hidden" value="<?php echo URL; ?>" id="url">
    <input type="hidden" value="<?php echo ASSETS_PATH; ?>" id="assets">
    <input type="hidden" value="<?php echo IMG_PATH; ?>" id="images">
    <input type="hidden" id="longitud">
    <input type="hidden" id="latitud">
    <input type="hidden" id="file_temp" value="">
    <input type="hidden" name="" id="src_file">
    <input type="hidden" id="is_loaded_cfg" value="<?php echo WHEATHER_KEY ?>">

    <body class="body-bg">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- preloader area start -->
        <div id="preloader">
            <div class="loader"></div>
        </div>
        <!-- preloader area end -->
        <!-- page container area start -->
        <div class="page-container">
            <!-- sidebar menu area start -->
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <div class="logo">
                        <a href="<?php echo URL ?>"><img src="<?php echo URL . URL_LOGO ?>" style="width: 300px; zoom:200% !important;" alt="logo"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li id="tablero"><a href="<?php echo URL; ?>"><i class="mdi mdi-chart-histogram"></i>
                                        <span>Tablero</span></a></li>
                                <li id="mantenimiento">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="mdi mdi-city-variant-outline"></i><span>Gestión de campo</span></a>
                                    <ul>
                                        <li id="man_dist"><a href="<?php echo URL ?>gestion/distritos">Mantenimiento de
                                                distritos</a></li>
                                        <li id="man_zon"><a href="<?php echo URL ?>gestion/zonas">Mantenimiento de Zonas</a>
                                        </li>
                                        <li id="mant_man"><a href="<?php echo URL ?>gestion/manzanas">Mantenimiento de
                                                Manzanas</a></li>
                                    </ul>
                                </li>
                                <li id="mantu">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="mdi mdi-account-box-multiple"></i><span>Usuarios</span></a>
                                    <ul class="collapse">
                                        <li id="mantu_usu"><a href="<?php echo URL ?>usuario/mantenimiento">Mantenimientos
                                                Usuarios</a></li>
                                        <li id="mantu_usu"><a href="<?php echo URL ?>usuario/asignacion">Asignación</a></li>
                                        <li id="mantu_tipos"><a href="<?php echo URL ?>usuario/tipos">Tipos de Usuarios</a>
                                        </li>
                                        <li id="mantu_tipos"><a href="<?php echo URL ?>usuario/metas">Metas</a></li>
                                    </ul>
                                </li>
                                <li id="mantu">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="mdi mdi-card-account-mail-outline"></i><span>Personas</span></a>
                                    <ul class="collapse">
                                        <li id="mantu_usu"><a href="<?php echo URL ?>usuario/personas">Gestionar
                                                Personas</a></li>
                                    </ul>
                                </li>
                                <li id="mantu">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="mdi mdi mdi-android-messages"></i><span>Comunicación</span></a>
                                    <ul class="collapse">
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/create_call">Crear Llamada</a></li>
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/app/internal">Mensajería Interna</a></li>
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/app/external">Mensajería Externa</a></li>

                                        <!-- <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/config">Configurar</a></li> -->
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/reporte">Reporte de
                                                mensajes</a></li>
                                        <!-- <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/archivos">Archivos</a></li> -->
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/errores">Errores con
                                                números</a></li>
                                        <li id="mantu_usu"><a href="<?php echo URL ?>mensajeria/plantillas">Plantillas</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="plantillas"><a href="<?php echo URL; ?>service/plantillas/"><i class="mdi mdi-file-excel"></i> <span>Plantillas</span></a></li>
                                <li id="mapa"><a href="<?php echo URL; ?>informe/mapa"><i class="mdi mdi-google-maps"></i>
                                        <span>Mapa</span></a></li>
                                <li id="informes"><a href="<?php echo URL; ?>informe/campo"><i class="mdi mdi-chart-bar-stacked"></i> <span>Progreso de campo</span></a></li>
                                <li id="informes"><a href="<?php echo URL; ?>informe/menu"><i class="mdi mdi-chart-bar-stacked"></i> <span>Informes</span></a></li>
                                <?php
                                if (Session::get('usuid') == 1) {
                                ?>
                                    <li id="informes"><a href="<?php echo URL; ?>super/gestion"><i class="mdi mdi-account"></i>
                                            <span>Cuentas</span></a></li>

                                <?php
                                }
                                ?>
                                <li id="ajustes"><a href="<?php echo URL; ?>super/ajustes"><i class="mdi mdi-application-cog-outline"></i> <span>Ajustes Sistema</span></a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <?php
                        echo dynamic_navigation($_REQUEST['url']);
                        ?>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">
                                <img class="avatar user-thumb" src="<?php echo ASSETS_PATH ?>images/author/user.jpg" alt="avatar">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                    <?php echo strtoupper(Session::get('user')); ?> <i class="fa fa-angle-down"></i>
                                </h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo URL ?>profile/">Mi perfil</a>
                                    <a class="dropdown-item logout-actioner" href="javascript:;">Salir</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="main-content-inner">
                <?php else :
                // EN CASO DE QUE NO ESTÉ LOGEADO RENDERIZA EL HEADER DEL LOGIN
                ?>
                  <!DOCTYPE html>
									<html class="no-js" lang="es">

									<head>
										<meta charset="utf-8">
										<meta http-equiv="x-ua-compatible" content="ie=edge">
										<meta name="viewport" content="width=device-width, initial-scale=1.0">
										<meta name="viewport" content="width=device-width, initial-scale=1">

										<title>
											<?php echo dynamic_page_title($_REQUEST['url']); ?>
										</title>
										<link rel="shortcut icon" type="image/png" href="<?php echo URL ?>favicon.ico">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/bootstrap.min.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/font-awesome.min.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/themify-icons.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/metisMenu.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/custom.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/owl.carousel.min.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/slicknav.min.css">
										<!-- amchart css -->
										<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
										<!-- others css -->
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/typography.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/default-css.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/styles.css">
										<link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/responsive.css">
										<input type="hidden" value="<?php echo URL; ?>" id="url">
										<input type="hidden" value="<?php echo ASSETS_PATH; ?>" id="assets">
										<input type="hidden" value="<?php echo IMG_PATH; ?>" id="images">

										<?php
										render_resources('css', $this->css);
										?>
										<!-- modernizr css -->
										<script src="<?php echo ASSETS_PATH ?>js/vendor/modernizr-2.8.3.min.js"></script>
										<!-- jquery latest version -->
										<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
										<script src="https://cdn.jsdelivr.net/npm/disableautofill/src/jquery.disableAutoFill.min.js"></script>

									</head>
									<noscript>
										javascript error, please enable JavaScript for loading this paage
									</noscript>

									<body>
										<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
										<!-- preloader area start -->
										<div id="preloader">
											<div class="loader"></div>
										</div>


                    <?php endif;
                    ?>