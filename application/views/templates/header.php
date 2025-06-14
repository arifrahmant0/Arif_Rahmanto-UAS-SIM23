<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title><?= isset($title) ? $title : 'PT. Maju Jaya - Sistem Sales Order' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="nav-link">Login sebagai: <strong><?= $this->session->userdata('username') ?></strong></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">PT. Maju Jaya</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 d-flex">
          <div class="info">

          </div>
        </div>

        <!-- Load sidebar sesuai role -->
        <?php $this->load->view('templates/sidebar'); ?>

      </div>
    </aside>