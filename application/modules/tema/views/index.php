<?= $this->load->view('header') ?>

<body>

<?= $this->load->view('navbar')  ?>

  <!-- ======= Hero Section ======= -->
<?= $this->load->view('wall') ?>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
<!-- <?= $this->load->view('about') ?> -->
    <!-- End About Section -->

    <!-- ======= Features Section ======= -->
<?= $this->load->view('fitur'); ?>
    <!-- End Features Section -->

    <!-- ======= Counts Section ======= -->
<?= $this->load->view('count') ?>
    <!-- End Counts Section -->

    <!-- ======= Details Section ======= -->
<?= $this->load->view('detil') ?>
    <!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
<!-- <?= $this->load->view('galery') ?> -->
    <!-- End Gallery Section -->

    <!-- ======= Testimonials Section ======= -->
<!-- <?= $this->load->view('testimoni') ?> -->
    <!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
<!-- <?= $this->load->view('tim.php') ?> -->
    <!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
<!-- <?= $this->load->view('price') ?> -->
    <!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
<?= $this->load->view('faq') ?>
    <!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
<?= $this->load->view('contact') ?>
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?= $this->load->view('footer') ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
<?= $this->load->view('script') ?>

</body>

</html>