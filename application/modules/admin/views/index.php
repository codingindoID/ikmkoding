   <style type="text/css" media="screen">
     .small-box{
      height: 150px;
    }
    .a{
      color: white;
    }
  </style>
  <script src="<?php echo site_url('assets/highchart/')?>highcharts.js"></script>
  <script src="<?php echo site_url('assets/highchart/')?>highcharts-3d.js"></script>
  <script src="<?php echo site_url('assets/highchart/')?>exporting.js"></script>
  <script src="<?php echo site_url('assets/highchart/')?>export-data.js"></script>
  <script src="<?php echo site_url('assets/highchart/')?>accessibility.js"></script>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $kepuasan ?><sup>%</sup></h3>
              <p>Index Kepuasan</p>
              <p style="font-weight: bold; font-size: 20px;"><?php echo strtoupper($tingkat_kepuasan) ?></p>
            </div>
            <div class="icon">
              <i class="ion-pie-graph"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $responden ?></h3>
              <p>Total Responden</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="" title="">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $s_publish ?></h3>

              <p>Survey Ter<strong>Publish</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo site_url('admin/publish') ?>" title="">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $b_publish ?></h3>

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
      <section class="col-lg-7 connectedSortable">

        <!-- Table Data Pilihan -->
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Statistik</h3>
            <a style="margin-left: 20px;" target="_blank" class="btn-sm btn-success" href="<?php echo site_url('admin/cetakrekap') ?>" title="cetak"><i class="fa fa-print"></i> Cetak</a>
            <a style="margin-left: 10px;" target="_blank" class="btn-sm btn-success" href="<?php echo site_url('admin/cetakrekapdetil') ?>" title="cetak"><i class="fa fa-print"></i> Cetak Detil</a>
          </button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <div class="table-responsive">
            <table class="table" border="1px" >
              <thead>
                <tr style="background-color: #1f6f8b; color: white;">
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                  <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
                  <th class="text-center" rowspan="1" style="background-color: #8bcdcd; color: white;" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
                  <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
                </tr>
                <tr style="background-color: #28abb9; color: white;">
                 <th class="text-center" width="10%" style="vertical-align: middle;">Sangat Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle;" >Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle;">Kurang Puas</th>
                 <th class="text-center" width="10%" style="vertical-align: middle;" >Kecewa</th>
               </tr>
             </thead>
             <tbody>
              <?php foreach ($rekap as $data): 
                $kepuasan = $data['kepuasan'];
                if ($kepuasan >= 1 && $kepuasan <= 2.5996 ) {
                  $index = 'D';
                }else if($kepuasan >= 2.60 && $kepuasan <= 3.064){
                  $index = 'C';
                }else if($kepuasan >= 3.0644 && $kepuasan < 3.532){
                  $index = 'B';
                } else if($kepuasan >= 3.5324 && $kepuasan <= 4){
                  $index = 'A';
                } else {
                  $index = null;
                }
                ?>
                <tr>
                  <td class="text-center" style="font-weight: bold;"><?php echo $data['id_soal'] ?></td>
                  <td  style="font-weight: bold;"><?php echo $data['kategori'] ?></td>
                  <td class="text-center"><?php echo $data['sp'] != null ? '<strong>'.$data['sp'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['p'] != null ? '<strong>'.$data['p'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['tp'] != null ? '<strong>'.$data['tp'].'</strong>' : '-' ?></td>
                  <td class="text-center"><?php echo $data['kec'] != null ? '<strong>'.$data['kec'].'</strong>' : '-' ?></td>
                  <td class="text-center" style="font-weight: bold;"><?php echo $data['kepuasan'] ?></td>
                  <td  class="text-center" style="font-weight: bold;"><?php echo $index ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>
  <!-- /.Left col -->
  <section class="col-lg-5 connectedSortable">
    <!-- Diagram Pilihan-->
    <div class="box box-solid bg-light-blue-gradient">
      <div class="box-header">
        <h3 class="box-title">
          Data Pilihan
        </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
       <figure class="highcharts-figure" style="padding: 10px; margin-top: -30px;">
        <div id="container"></div>

      </figure>
    </div>
  </div>
  <!-- /.box -->

  <!-- solid sales graph -->
  <div class="box box-solid" style="background-color: #f6f5f5">
    <div class="box-header">
      <i class="fa fa-th"></i>

      <h3 class="box-title">Rata - rata Pilihan Responden</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body border-radius-none">
     <figure class="highcharts-figure">
      <div id="pie"></div>
    </figure>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

</section>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
      type: 'column',
      backgroundColor: 'transparent'
    },
    title: {
      text: 'Statistik Kepuasan Masyarakat',
      color : '#f6f5f5'
    },
    subtitle: {
      text: 'Mall Pelayanan Publik'
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          color : '#f6f5f5',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Index Kepuasan',
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      pointFormat: 'Index Kepuasan'
    },
    series: [
    {
      name: 'Kepuasan',
      data: [
      <?php foreach ($rekap as $data): ?>
        {
          name: '<?php echo $data['id_soal'] ?>',
          color: '#f6f5f5',
          y: <?php echo $data['kepuasan'] ?>
        },
      <?php endforeach ?>
      ],
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }]
      });
    </script>
    <script type="text/javascript">
      Highcharts.chart('pie', {
        chart: {
          type: 'pie',
          backgroundColor: 'transparent'
        },
        title: {
          text: ''
        },
        exporting: {
          enabled: false
        },
        accessibility: {
          point: {
            valueSuffix: '%'
          }
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b>: {point.percentage:.1f} %',
              borderWidth: 0,
              shadow: false,
              font: '11px Trebuchet MS, Verdana, sans-serif'
            }
          }
        },
        series: [{
          name: 'Kepuasan',
          colorByPoint: true,
          data: <?php echo json_encode($hasil) ?>
        }]
      });
    </script>