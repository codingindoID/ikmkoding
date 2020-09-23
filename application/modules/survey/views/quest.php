<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<style type="text/css">
  .row{
    margin-bottom: 20px;
  }
  .form-check-label{
    font-size: 20px;
    margin-left: 10px;
  }

  #lanjut{
    margin-right: 50px;
    width: 150px;
    margin-top: 3%;
  }

</style>
<?= $this->load->view('sesi/header') ?>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:3%; ">
        <div class="row content">
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <h3 id="pertanyaan"><?php echo $soal[0]->soal ?></h3>
            <p class="font-italic">
              Pilihan :
            </p>
            <ul>
             <div class="row">
              <div class="col">
                <div class="form-check form-check-inline">
                  <input required class="form-check-input" type="radio" name="pilihan" id="c1" value="a">
                  <label class="form-check-label" for="inlineRadio1" id="a">a</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="pilihan" id="c2" value="b">
                  <label class="form-check-label" for="inlineRadio1" id="b">b</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="pilihan" id="c3" value="c">
                  <label class="form-check-label" for="inlineRadio1" id="c">c</label>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="pilihan" id="c4" value="d">
                  <label class="form-check-label" for="inlineRadio1" id="d">d</label>
                </div>
              </div>
            </div>
          </ul>
          <p>
            <button id="lanjut" class="btn btn-success float-right">Selanjutnya  <i class="fa fa-arrow-circle-right"></i></button>
          </p>
        </div>
        <div class="col-md-4" data-aos="fade-right">
          <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
        </div>
      </div>

    </div>
  </section>
  <input type="hidden" id="base" value="<?php echo site_url() ?>">
  <input type="hidden" id="noreg" value="<?php echo $noreg ?>">
  <input type="hidden" id="n_soal" value="<?php echo $nsoal ?>">
  <input type="hidden" id="id_soal" value="<?php echo $soal[0]->id_soal ?>">
</main>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

<?= $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/jsku.js"></script>

</body>

</html>