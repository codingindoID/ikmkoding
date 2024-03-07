<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url('assets/dist/img/app.jpg') ?>">
  <title>SKMMPP - DPMPTSP JEPARA || <?php echo $title . ' - ' . $sub ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>table.css">

  <!-- script -->
  <script src="<?php echo base_url() . 'assets/' ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() . 'assets/' ?>apexcharts.js"></script>
  <script src="<?php echo base_url() . 'assets/js/' ?>sweetalert2@10.js"></script>
  <div id="base_url" data-id="<?php echo site_url() ?>"></div>
</head>

<body class="hold-transition skin-purple-light sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('navbar'); ?>