<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>K</b>BMT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Koperasi</b>BMT</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="../assets/dist/img/Logo.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Sekretaris</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Dashboard</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-database"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dataanggota.php">Data Anggota</a></li>
              <li><a href="datatabungan.php">Data Tabungan Anggota</a></li>
              <li><a href="datasimpanan.php">Data Simpanan</a></li>
              <li><a href="datapinjaman.php">Data Peminjaman</a></li>
              <li><a href="datapengambilan.php">Data Pengambilan</a></li>
              <li><a href="datapembayaran.php">Data Pembayaran</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-file"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="laporansimpanan.php">Laporan Simpanan</a></li>
              <li><a href="laporanpinjaman.php">Laporan Pinjaman</a></li>
              <li><a href="laporanpengambilan.php">Laporan Pengambilan</a></li>
              <li><a href="laporankeuangan.php">Laporan Keuangan</a></li>
            </ul>
          </li>
          <li><a href="../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php 
      include ("../config/koneksi.php");
      session_start();
      if ($_SESSION['level'] != 'sekretaris') {
        echo '<script>alert("Anda Harus Login Sebagai Sekretaris!");</script>';
        echo '<script>window.location.href="../index.php";</script>';
      }
      ?>
    <!-- Main content -->
    <section class="content container-fluid">