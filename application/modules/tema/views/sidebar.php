
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url().'assets/'?>dist/img/app.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('ses_username') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>Online</a>

      </div>
    </div>
    <!-- /.search form -->
    <form action="<?php echo site_url('search') ?>" method="post" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="cari" class="form-control" placeholder="cari kunjungan. . .">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color:black">MENU UTAMA</li>
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard fa-black"></i>
          <span>Admin</span>
        </a>
        <ul id="menu_surat" class="treeview-menu">
          <li><a href="#"><i class="fa  fa-exchange"></i>Pertanyaan</a></li>
          <li><a href="#"><i class="fa fa-filter"></i>Report</a></li>
        </ul>
      </li>
  </section>
  <!-- /.sidebar -->
</aside>
