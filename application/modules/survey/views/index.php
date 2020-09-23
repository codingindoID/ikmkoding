<?= $this->load->view('sesi/header') ?>

<body>

<?= $this->load->view('sesi/navbar')  ?>
<?= $this->load->view('sesi/wall') ?>

  <main id="main">
<?= $this->load->view('sesi/fitur'); ?>
<?= $this->load->view('sesi/count') ?>
<?= $this->load->view('sesi/detil') ?>
<?= $this->load->view('sesi/faq') ?>
<?= $this->load->view('sesi/contact') ?>
  </main>
<?= $this->load->view('sesi/footer') ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

<?= $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/wall.js"></script>

</body>

</html>