<?= $this->load->view('sesi/header') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/star.css">

<body>
    <?= $this->load->view('sesi/navbar2')  ?>
    <!-- <audio controls autoplay>
        <source src="<?= base_url('assets/sound/terimakasih_atas_penilaian.mp3') ?>" type="audio/mp3">
    </audio> -->
    <main id="main">
        <section id="details" class="details">
            <div class="container text-center halaman" style="margin-top:1%; ">
                <!-- <img src="<?= base_url('assets/img/terimakasih.jpg') ?>" style="max-width: 100px; width: 100%;" alt=""> -->
                <div class="total_rating font-weight-bold">
                    <?= number_format($star, 1) ?>
                </div>
                <div class="star-ratings">
                    <div class="fill-ratings" style="width: <?= $persen ?>%;">
                        <span>★★★★</span>
                    </div>
                    <div class="empty-ratings">
                        <span>★★★★</span>
                    </div>
                </div>
                <h5 class="font-weight-bold text-info">TERIMAKASIH ATAS PENILAIAN LAYANAN KAMI</h5>
                <h6 class="font-weight-bold text-info">-- SALAM JEPARA INVESTEAM --</h6>
                <a href="<?= site_url('') ?>" class="btn btn-success mt-5"><i class="icofont-home"></i> Kembali Ke Beranda</a>
            </div>
        </section>
        <audio src="<?= base_url('assets/sound/terimakasih_atas_penilaian.mp3') ?>" id="my_audio" autoplay="autoplay"></audio>
    </main>
    <div id="preloader"></div>

    <?= $this->load->view('sesi/script') ?>
    <script>
        $(document).ready(function() {
            $("#my_audio").get(0).play()
            var star_rating_width = $('.fill-ratings span').width()
            $('.star-ratings').width(star_rating_width)
        });
    </script>
</body>

</html>