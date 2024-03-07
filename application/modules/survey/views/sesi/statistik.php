<style type="text/css" media="screen">
  .table-wrapper {
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
  }

  .fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
  }

  .fl-table td,
  .fl-table th {
    text-align: center;
    padding: 8px;
  }

  .fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
  }

  .fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
  }



  .fl-table tr:nth-child(even) {
    background: #F8F8F8;
  }
</style>
<section id="statistik" style="margin-top: -20px;">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-xs-12" data-aos="fade-right">
        <div class="card" style="margin-bottom: 5px;">
          <div class="card-body">
            <br>
            <div id="chart-kategori"></div>
          </div>
        </div>
      </div>
      <!-- diagram -->
      <div class="col-md-5 col-xs-12" data-aos="fade-up">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="font-weight-bold text-center">Responden Berdasarkan Pendidikan</p>
                <div id="piepend"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 5px;">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="font-weight-bold text-center">Responden Berdasarkan Pekerjaan</p>
                <div id="piepek"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card" style="margin-top: 15px;">
      <div class="card-body">
        <p><strong>Detil Jawaban Responden Per Kategori</strong></p>
        <div class="table-responsive" style="margin-top: 10px;">
          <table class="fl-table">
            <thead style="background-color: #f4f4f2;">
              <tr>
                <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
                <th class="text-center" rowspan="1" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
              </tr>
              <tr>
                <th class="text-center" width="10%">Sangat Puas</th>
                <th class="text-center" width="10%">Puas</th>
                <th class="text-center" width="10%">Kurang Puas</th>
                <th class="text-center" width="10%">Kecewa</th>
              </tr>
            </thead>
            <tbody id="body-mutu">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>