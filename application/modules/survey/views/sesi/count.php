<style>
.boxc{
  height: 180px;
}
</style>
<section id="counts" class="counts">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Statistik Pelayanan</h2>
      <div class="row">
       <div class="col">
        <p>Data Pelayanan</p>
      </div>
    </div>
  </div>


  <div class="row" data-aos="fade-up">
    <div class="col-md-4 col-xs-6 mt-3">
      <div class="count-box boxc">
        <i class="icofont-simple-smile"></i>
        <span data-toggle="counter-up"><?php echo $kepuasan ?></span>
        <p>Index Kepuasan (%)</span></p>

        <h4><strong><?php echo $tingkat_kepuasan; ?></strong></h4>
      </div>
    </div>
    <div class="col-md-4 col-xs-6 mt-3">
      <div class="count-box boxc">
        <i class="icofont-users-alt-5"></i>
        <span data-toggle="counter-up"><?php echo $pengunjung ?></span>
        <p>Total Responden</p>
      </div>
    </div>
    <div class="col-md-4 col-xs-6 mt-3">
      <div class="count-box boxc">
        <i class="icofont-live-support"></i>
        <span data-toggle="counter-up"><?php echo $loket ?></span>
        <p>Total Loket Pelayanan</p>
      </div>
    </div>
  </div>


  <div class="row"  data-aos="fade-up">
    <div class="col-md-6 col-xs-6 mt-3">
      <div class="count-box boxc">
        <i class="icofont-live-support"></i>
        <span data-toggle="counter-up" id="visitor_now">0</span>
        <p>Pengunjung Hari Ini</p>
      </div>
    </div>
    <div class="col-md-6 col-xs-6 mt-3">
      <div class="count-box boxc">
        <i class="icofont-live-support"></i>
        <span data-toggle="counter-up" id="visitor_all">0</span>
        <p>Total Pengunjung</p>
      </div>
    </div>
  </div>

</div>
</section>
