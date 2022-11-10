<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ERROR - <?php echo APP_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo URL ?>favicon.ico">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/metisMenu.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/owl.carousel.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/typography.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/default-css.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/responsive.css">
    <!-- modernizr css -->
    <script src="<?php echo ASSETS_PATH ?>js/vendor/modernizr-2.8.3.min.js"></script>
    <?php 
        render_resources('css', $this->css);
    ?>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">