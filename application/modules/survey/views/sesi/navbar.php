<header id="header" class="fixed-top d-flex align-items-center header-transparent">
  <div class="container d-flex align-items-center">

    <div class="logo mr-auto">
      <h1 class="text-light"><a href="<?php echo site_url() . 'survey' ?>"><span><i class="icofont-ui-file"></i> SKM</span></a></h1>
    </div>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="<?php echo site_url() . 'survey' ?>"><i class="icofont-ui-home"></i> Home</a></li>
        <li><a href="#counts"><i class="icofont-chart-line"></i> Statistik</a></li>
        <li><a href="#details"><i class="icofont-info-circle"></i> Info</a></li>
        <li><a href="#faq"><i class="icofont-question-circle"></i> FAQ</a></li>
        <li><a href="#contact"><i class="icofont-contacts"></i> Contact</a></li>
        <?php if ($this->session->userdata('ses_user') != null) : ?>
          <li><a href="<?php echo site_url('admin') ?>"><strong><i class="icofont-gears"></i> Admin</strong></a></li>
        <?php endif ?>
      </ul>
    </nav>

  </div>
</header>