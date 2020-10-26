
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
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color:black">MENU UTAMA</li>
      <li>
        <a href="<?php echo site_url('admin') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        <a href="<?php echo site_url() ?>">
          <i class="fa fa-mail-forward "></i> <span>FrontEnd</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-tasks fa-black"></i>
          <span>Admin</span>
        </a>
        <ul id="menu_surat" class="treeview-menu">
          <li><a href="<?php echo site_url('admin/pertanyaan') ?>"><i class="fa  fa-edit"></i>Pertanyaan</a></li>
          <li><a href="<?php echo site_url('admin/publish') ?>"><i class="fa fa-send"></i>Publish</a></li>
           <li><a href="<?php echo site_url('admin/saran') ?>"><i class="fa fa-file"></i>Kritik dan Saran</a></li>
        </ul>
      </li>
    </section>
    <!-- /.sidebar -->
  </aside>
