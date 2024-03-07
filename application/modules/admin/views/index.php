<style type="text/css" media="screen">
  .small-box {
    height: 150px;
  }

  .a {
    color: white;
  }

  @import url(https://fonts.googleapis.com/css?family=Poppins&display=swap);

  body {
    font-family: Poppins, sans-serif;
  }
</style>
<!-- Main content -->
<section class="content" style="margin-left: -1em">
  <div class="box" style="margin-top: -2em">
    <div class="box-body">
      <div class="form-group row">
        <div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
          <select name="bulan" id="bulan_filter" onchange="filterDataAdmin(this)" class="form-control" required>
            <option value="">Setahun</option>
            <?php foreach ($bulan as $b) : ?>
              <option <?= $f_bulan == $b->id_bulan ? 'selected' : '' ?> value="<?= $b->id_bulan ?>"><?= $b->bulan ?></option>}
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
          <select name="tahun" id="tahun_filter" onchange="filterDataAdmin(this)" class="form-control" required>
            <option value="">Tahun..</option>
            <?php foreach ($tahun as $t) : ?>
              <option <?= $f_tahun == $t->tahun ? 'selected' : '' ?> value="<?= $t->tahun ?>"><?= $t->tahun ?></option>}
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-12" style="margin-top: 0.3em">
          <button onclick="cetakLaporan(this)" type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak Laporan</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <a href="" title="">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><span id="text-persen-kepuasan">-</span><sup>%</sup></h3>
            <p>Index Kepuasan</p>
            <p style="font-weight: bold; font-size: 20px;"><span id="text-kepuasan">-</span><strong id="text-mutu-kepuasan">()</strong></p>
          </div>
          <div class="icon">
            <i class="ion-pie-graph"></i>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <a href="" title="">
        <div class="small-box bg-green">
          <div class="inner">
            <h3 id="text-total-responden">-</h3>
            <p>Total Responden</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <a href="<?php echo site_url('admin/publish') ?>" title="">
        <div class="small-box bg-red">
          <div class="inner">
            <h3 id="text-belum-publish">-</h3>

            <p>Survey Belum Di-<strong>Publish</strong></p>
          </div>
          <div class="icon">
            <i class="glyphicon glyphicon-time"></i>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <section class="col-lg-12 connectedSortable">

      <!-- Table Data Pilihan -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Statistik</h3>
          <a href="#" style="margin-left: 20px;" class="btn-sm btn-primary" onclick="exportData(this)" title="cetak"><i class="fa fa-file-excel-o"></i> export</a>
          <a href="#" style="margin-left: 10px;" class="btn-sm btn-success" data-jenis="<?= KODEPELAYANAN ?>" onclick="exportDetail(this)" title="cetak"><i class="fa fa-file-excel-o"></i> Export Detil</a>
          <a href="#" style="margin-left: 10px;" class="btn-sm btn-info" data-jenis="<?= KODEKPK ?>" onclick="exportDetail(this)" title="cetak"><i class="fa fa-file-excel-o"></i> Export Detil ( KPK )</a>
          </button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="fl-table" border="1px">
              <thead>
                <tr style="background-color: #1f6f8b; color: white;">
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                  <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
                  <th class="text-center" rowspan="1" style="background-color: #68b0ab; color: white;" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
                </tr>
                <tr style="color: white;">
                  <th class="text-center" width="10%" style="vertical-align: middle; background-color: #0278ae">Sangat Puas</th>
                  <th class="text-center" width="10%" style="vertical-align: middle; background-color: #01c5c4">Puas</th>
                  <th class="text-center" width="10%" style="vertical-align: middle; background-color: #f0a500">Kurang Puas</th>
                  <th class="text-center" width="10%" style="vertical-align: middle; background-color: red;">Kecewa</th>
                </tr>
              </thead>
              <tbody id="body-mutu">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box -->
    </section>

    <section class="col-xl-12 col-lg-12 col-md-12 col-xs-12 connectedSortable">
      <!-- Diagram Pilihan-->
      <div class="box box-solid">
        <div class="box-body">
          <div id="chart-column-kategori">
          </div>
        </div>
      </div>
    </section>

    <section class="col-xl-4 col-lg-4 col-md-4 col-xs-12 connectedSortable" style="height: 100%;">
      <!-- solid sales graph -->
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-th"></i>

          <h3 class="box-title">Kategori Pemilih Berdasarkan Pekerjaan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div id="pie-pekerjaan">
          </div>
        </div>
      </div>
    </section>

    <section class="col-xl-4 col-lg-4 col-md-4 col-xs-12 connectedSortable" style="height: 100%;">
      <!-- solid sales graph -->
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-th"></i>

          <h3 class="box-title">Rata - rata Pilihan Responden</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div id="pie-pilihan"></div>
        </div>
      </div>
    </section>

    <section class="col-xl-4 col-lg-4 col-md-4 col-xs-12 connectedSortable" style="height: 100%;">
      <!-- solid sales graph -->
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-th"></i>

          <h3 class="box-title">Kategori Pemilih Berdasarkan Pendidikan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div id="pie-pendidikan"></div>
        </div>
      </div>
    </section>
    <!-- /.box -->

  </div>
</section>

<script>
  let base_url = $('#base_url').data('id');
  let bulan = $('#bulan_filter').val()
  let tahun = $('#tahun_filter').val()

  ajaxCount(bulan, tahun)
  ajaxColumnPilihan(bulan, tahun)
  tableMutu(bulan, tahun)

  /* PIE PEKERJAAN */
  var optionsPekerjaan = {
    series: [],
    chart: {
      width: 420,
      type: 'pie',
    },
    legend: {
      position: 'bottom'
    },
    labels: [],
    responsive: [{
      breakpoint: 400,
      options: {
        chart: {
          width: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };
  var chartPekerjaan = new ApexCharts(document.querySelector("#pie-pekerjaan"), optionsPekerjaan);
  chartPekerjaan.render();
  ajaxPiePekerjaan(bulan, tahun)

  /* PIE PILIHAN */
  var optionsPilihan = {
    series: [],
    chart: {
      width: 420,
      type: 'pie',
    },
    legend: {
      position: 'bottom'
    },
    labels: [],
    responsive: [{
      width: 420,
      options: {
        chart: {
          width: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  var chartPilihan = new ApexCharts(document.querySelector("#pie-pilihan"), optionsPilihan);
  chartPilihan.render();
  ajaxPiePilihan(bulan, tahun)

  /* PIE PENDIDIKAN */
  var optionsPendidikan = {
    series: [],
    chart: {
      width: 420,
      type: 'pie',
    },
    labels: [],
    legend: {
      position: 'bottom'
    },
    responsive: [{
      width: 420,
      options: {
        chart: {
          width: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  var chartPendidikan = new ApexCharts(document.querySelector("#pie-pendidikan"), optionsPendidikan);
  chartPendidikan.render();
  ajaxPiePendidikan(bulan, tahun)

  var optionsColumnPilihan = {
    title: {
      text: "Statistik Pilihan Responden per kategori soal",
    },
    chart: {
      type: "bar",
      height: 300
    },
    series: [{
      name: "Mutu",
      data: [],
    }],
    plotOptions: {
      bar: {
        columnWidth: '70%',
      },
    },
    xaxis: {
      categories: [],
    },
  };
  var chartColumnPilihan = new ApexCharts(document.querySelector("#chart-column-kategori"), optionsColumnPilihan);
  chartColumnPilihan.render();

  function filterDataAdmin(ctx) {
    let bulan = $('#bulan_filter').val()
    let tahun = $('#tahun_filter').val()
    ajaxCount(bulan, tahun)
    tableMutu(bulan, tahun)
    ajaxPiePekerjaan(bulan, tahun)
    ajaxPiePendidikan(bulan, tahun)
    ajaxPiePilihan(bulan, tahun)
    ajaxColumnPilihan(bulan, tahun)
  }

  function ajaxCount(bulan, tahun) {
    $.ajax({
      type: "post",
      url: `${base_url}ajax-count`,
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      dataType: "json",
      success: function(response) {
        $('#text-persen-kepuasan').text(response.persen)
        $('#text-kepuasan').text(response.kategori_kepuasan + " ")
        $('#text-mutu-kepuasan').text(response.mutu)
        $('#text-total-responden').text(response.total_responden)
        $('#text-belum-publish').text(response.belum_publish)
      }
    });
  }

  function tableMutu(bulan, tahun) {
    $('#body-mutu').html("")
    $.ajax({
      type: "post",
      url: `${base_url}ajax-table-mutu`,
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      dataType: "json",
      success: function(response) {
        $('#body-mutu').html(response.data)
      }
    });
  }

  function ajaxPiePekerjaan(bulan, tahun) {
    $.ajax({
      type: "post",
      url: `${base_url}ajax-chart-pekerjaan`,
      dataType: "json",
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      success: function(response) {
        chartPekerjaan.updateOptions({
          series: response.data,
          labels: response.label,
        })
      }
    });

  }

  function ajaxPiePendidikan(bulan, tahun) {
    $.ajax({
      type: "post",
      url: `${base_url}ajax-chart-pendidikan`,
      dataType: "json",
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      success: function(response) {
        chartPendidikan.updateOptions({
          series: response.data,
          labels: response.label,
        })
      }
    });

  }

  function ajaxPiePilihan(bulan, tahun) {
    $.ajax({
      type: "post",
      url: `${base_url}ajax-chart-pilihan`,
      dataType: "json",
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      success: function(response) {
        chartPilihan.updateOptions({
          series: response.data,
          labels: response.label,
        })
      }
    });
  }

  function ajaxColumnPilihan(bulan, tahun) {
    $.ajax({
      type: "post",
      url: `${base_url}ajax-column-pilihan`,
      dataType: "json",
      data: {
        'tahun': tahun,
        'bulan': bulan,
      },
      success: function(response) {
        chartColumnPilihan.updateOptions({
          series: [{
            data: response.data,
          }],
          xaxis: {
            categories: response.label,
          }
        })
      }
    });
  }

  /* CETAK */
  function exportData() {
    let bulan = $('#bulan_filter').val()
    let tahun = $('#tahun_filter').val()
    bulan = bulan ? bulan : "setahun"
    location.href = `${base_url}export-data/${bulan}/${tahun}`;
  }

  function exportDetail(ctx) {
    let jenis = $(ctx).data('jenis')
    let bulan = $('#bulan_filter').val()
    let tahun = $('#tahun_filter').val()
    bulan = bulan ? bulan : "setahun"
    location.href = `${base_url}export-detail/${bulan}/${tahun}/${jenis}`;
  }

  function cetakLaporan(ctx) {
    let jenis = $(ctx).data('jenis')
    let bulan = $('#bulan_filter').val()
    let tahun = $('#tahun_filter').val()
    bulan = bulan ? bulan : "setahun"
    jenis = jenis ? jenis : 1
    location.href = `${base_url}laporan-skm/${bulan}/${tahun}/${jenis}`;
  }
</script>