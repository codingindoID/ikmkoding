<?= $this->load->view('sesi/header') ?>
<style>
  *:focus {
    outline: none !important;
  }
</style>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details">
      <div class="container" style="margin-top:3%; ">
        <form action="<?= site_url('survey/kirimJawaban') ?>" method="post" id="myform">
          <div class="card">
            <div class=" card-header bg-white pl-2 pb-0 font-weight-bold font-italic 0">
              <p class="text-primary">Pertanyaan :</p>
            </div>
            <div class="card-body body-quest">
              <?php
              $no = 1;
              $baris = 0;
              foreach ($soal as $var) : ?>
                <div class="row">
                  <div class="col-1 text-center font-weight-bold">
                    <?= $no++ ?>
                  </div>
                  <div class="col text-justify">
                    <h5><?= $var->soal ?></h5>
                  </div>
                </div>
                <div class="row mb-1">
                  <div class="col text-right">
                    <input type="hidden" name="id_soal[<?= $baris ?>]" value="<?= $var->id_soal ?>">
                    <input style="border: none; background-color: white; text-align: right;" type="text" name="jawaban[<?= $baris ?>]" id="jawaban_<?= $var->id_soal ?>" required value="" placeholder="Rating Belum Diisi">
                    <div class="widget-star">

                      <input type="radio" id="pilihan_a_<?= $var->id_soal ?>" value="a">
                      <label for="pilihan_a_<?= $var->id_soal ?>" class="fa fa-star" onclick="pilihan(this)" data-soal="<?= $var->id_soal ?>" data-id="pilihan_a_<?= $var->id_soal ?>" id="label_a_<?= $var->id_soal ?>"></label>

                      <input type="radio" id="pilihan_b_<?= $var->id_soal ?>" value="b">
                      <label for="pilihan_b_<?= $var->id_soal ?>" class="fa fa-star" onclick="pilihan(this)" data-soal="<?= $var->id_soal ?>" data-id="pilihan_b_<?= $var->id_soal ?>" id="label_b_<?= $var->id_soal ?>"></label>

                      <input type="radio" id="pilihan_c_<?= $var->id_soal ?>" value="c">
                      <label for="pilihan_c_<?= $var->id_soal ?>" class="fa fa-star" onclick="pilihan(this)" data-soal="<?= $var->id_soal ?>" data-id="pilihan_c_<?= $var->id_soal ?>" id="label_c_<?= $var->id_soal ?>"></label>

                      <input type="radio" id="pilihan_d_<?= $var->id_soal ?>" value="d">
                      <label for="pilihan_d_<?= $var->id_soal ?>" class="fa fa-star" onclick="pilihan(this)" data-soal="<?= $var->id_soal ?>" data-id="pilihan_d_<?= $var->id_soal ?>" id="label_d_<?= $var->id_soal ?>"></label>
                    </div>
                  </div>
                </div>
                <div class="separator"></div>
              <?php
                $baris++;
              endforeach ?>
              <div class="row">
                <div class="col">
                  <p>SARAN/MASUKAN : </p>
                  <textarea name="saran" rows="4 " class="form-control"></textarea>
                  <input type="hidden" name="id_responden" value="<?= $noreg ?>">
                </div>
              </div>
            </div>
            <div class="card-footer bg-white">
              <button type="submit" class="btn btn-success col-12">Kirim Jawaban <i class="fa fa-send"></i></button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
  <div id="preloader"></div>

  <?= $this->load->view('sesi/script') ?>
  <script>
    function pilihan(data) {
      var id = $(data).data('id')
      var soal = $(data).data('soal')

      switch (id) {
        case "pilihan_a_" + soal:
          $('#jawaban_' + soal).val(1)
          $('#label_a_' + soal).css("color", "gold")
          $('#label_b_' + soal).css("color", "grey")
          $('#label_c_' + soal).css("color", "grey")
          $('#label_d_' + soal).css("color", "grey")
          break;
        case "pilihan_b_" + soal:
          $('#jawaban_' + soal).val(2)
          $('#label_a_' + soal).css("color", "gold")
          $('#label_b_' + soal).css("color", "gold")
          $('#label_c_' + soal).css("color", "grey")
          $('#label_d_' + soal).css("color", "grey")
          break;
        case "pilihan_c_" + soal:
          $('#jawaban_' + soal).val(3)
          $('#label_a_' + soal).css("color", "gold")
          $('#label_b_' + soal).css("color", "gold")
          $('#label_c_' + soal).css("color", "gold")
          $('#label_d_' + soal).css("color", "grey")
          break;
        case "pilihan_d_" + soal:
          $('#jawaban_' + soal).val(4)
          $('#label_a_' + soal).css("color", "gold")
          $('#label_b_' + soal).css("color", "gold")
          $('#label_c_' + soal).css("color", "gold")
          $('#label_d_' + soal).css("color", "gold")
          break;
        default:
          $('#jawaban_' + soal).val("")
          $('#label_a_' + soal).css("color", "grey")
          $('#label_b_' + soal).css("color", "grey")
          $('#label_c_' + soal).css("color", "grey")
          $('#label_d_' + soal).css("color", "grey")
          break;
      }


    }
  </script>
</body>

</html>