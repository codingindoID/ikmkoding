<?php
$menu_admin = ['pertanyaan', 'publish', 'saran'];
$menu_news  = ['news', 'faq'];
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url() . 'assets/' ?>dist/img/app.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('skm_disp') ?></p>
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
        <ul class="treeview-menu" <?php if (in_array($menu, $menu_admin, true)) {
                                    echo 'style="display : block"';
                                  } ?>>
          <li <?php echo $menu == 'pertanyaan' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/pertanyaan') ?>"><i class="fa  fa-edit"></i>Pertanyaan</a></li>
          <li <?php echo $menu == 'publish' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/publish') ?>"><i class="fa fa-send"></i>Publish</a></li>
          <li <?php echo $menu == 'saran' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/saran') ?>"><i class="fa fa-file"></i>Kritik dan Saran</a></li>

        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bullhorn fa-black"></i>
          <span>News & FAQ</span>
        </a>
        <ul id="menu_surat" class="treeview-menu" <?php if (in_array($menu, $menu_news, true)) {
                                                    echo 'style="display : block"';
                                                  } ?>>
          <li <?php echo $menu == 'news' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/index') ?>"><i class="fa fa-rss-square"></i>News</a></li>
          <li <?php echo $menu == 'faq' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/FAQ') ?>"><i class="fa  fa-question"></i>FAQ</a></li>
        </ul>
      </li>
      <li <?php echo $menu == 'loket' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url('loket') ?>">
          <i class="fa fa-user-circle fa-black"></i>
          <span>Loket</span>
        </a>
      </li>
      <?php if ($this->session->userdata('skm_level') == LEVELSUPER) : ?>
        <hr>
        <li>
          <a href="<?php echo site_url() . 'admin/import' ?>">
            <i class="fa fa-upload fa-black"></i>
            <span>Import</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url() . 'admin/formAutomate/' ?>">
            <i class="fa fa-database"></i>
            <span>automate count Hasil</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url() . 'admin/formAutomateHasil/' ?>">
            <i class="fa fa-database"></i>
            <span>automate Rekap Hasil</span>
          </a>
        </li>

      <?php endif ?>
  </section>
  <!-- /.sidebar -->
</aside>