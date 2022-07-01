<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? $title : 'Title not set';  ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/summernote/summernote-bs4.min.css">
    <!-- jQuery -->
    <script src="<?php echo $this->config->config['base_url']; ?>template/jquery/jquery.min.js"></script>
    <script src="<?php echo $this->config->config['base_url']; ?>template/jsgrid/jsgrid.min.js"></script>
    <!-- jsgrid css -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/jsgrid/jsgrid.min.css">
    <!-- jsgrid theme css  -->
    <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>template/jsgrid/jsgrid-theme.min.css" />
    <!-- Bootstrap 4 -->
    <script src="<?php echo $this->config->config['base_url']; ?>template/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

</head>

<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">