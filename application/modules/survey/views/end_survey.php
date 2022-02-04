<?= $this->load->view('sesi/header') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/star.css">

<body>
    <?= $this->load->view('sesi/navbar2')  ?>
    <main id="main">
        <section id="details" class="details">
            <div class="container text-center halaman" style="margin-top:3%; ">

                <h5 class="font-weight-bold text-info">TERIMAKASIH ATAS PENILAIAN LAYANAN KAMI</h5>

                <div class="star-ratings">
                    <div class="fill-ratings" style="width: 35%;">
                        <span>★★★★</span>
                    </div>
                    <div class="empty-ratings">
                        <span>★★★★</span>
                    </div>
                </div>

                <h6 class="font-weight-bold text-info">-- SALAM JEPARA INVESTEAM --</h6>
                <button class="btn btn-success mt-5"><i class="icofont-home"></i> Kembali Ke Beranda</button>
            </div>
        </section>
    </main>
    <div id="preloader"></div>

    <?= $this->load->view('sesi/script') ?>
    <script>
        $(document).ready(function() {
            var star_rating_width = $('.fill-ratings span').width();
            $('.star-ratings').width(star_rating_width);
        });
    </script>
</body>

</html>