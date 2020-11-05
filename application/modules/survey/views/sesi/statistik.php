<section id="statistik" style="margin-top: -20px;">
  <div class="container">
    <div class="row">
      <div class="col-md-7" data-aos="fade-right">
       <div class="card" style="height: 535px;">
        <div class="card-body">
         <br>
         <div id="chart" ></div>
       </div>
     </div>
   </div>

   <!-- diagram -->
   <div class="col-md-5" data-aos="fade-up">
     <di class="row">
      <div class="col">
       <div class="card" style="height: 265px;">
        <div class="card-body">
          <div id="piepend">

          </div>
        </div>
      </div>
    </div>
  </di>
  <di class="row" style="margin-top: 5px;">
    <div class="col">
     <div class="card" style="height: 265px;">
      <div class="card-body">
        <div id="piepekerjaan">

        </div>
      </div>
    </div>
  </div>
</di>

</div>

</div>

<div class="card" style="margin-top: 15px;">

  <div class="card-body">
    <p><strong>Detil Jawaban Responden Per Kategori</strong></p>
    <div class="table-responsive" style="margin-top: 10px;">
  <table class="magic-table" >
    <thead style="background-color: #f4f4f2">
      <tr >
        <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
        <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
        <th class="text-center" rowspan="1"  colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
      </tr>
      <tr >
       <th class="text-center" width="10%">Sangat Puas</th>
       <th class="text-center" width="10%" >Puas</th>
       <th class="text-center" width="10%">Kurang Puas</th>
       <th class="text-center" width="10%" >Kecewa</th>
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


</div>

</section>

<?php 
$no= 1;
foreach ($rekap as $rekap) {
  $data[$no] = [
    'id_soal' => $rekap['id_soal'],
    'kepuasan'  => number_format($rekap['kepuasan'],2)
  ];
  $no++;
}
$kepuasan = array_column($data, 'kepuasan');
$id_soal  = array_column($data, 'id_soal');

//data pie
$h = 1;
foreach ($hasil as $hasil) {
  $dt[$h] = [
    'nilai' => $hasil['y'],
    'label' => $hasil['name']
  ];
  $h++;
}
$nilai_pie  = array_column($dt, 'nilai');
$label      = array_column($dt, 'label');

//data pendikan
$l = 1;
foreach ($pendidikan as $p) {
  $pk[$l] = [
    'jumlah'            => $p['jumlah'],
    'pendidikan'        => $p['pendidikan']
  ];
  $l++;
}
$j_pend     = array_column($pk, 'jumlah');
$l_pend     = array_column($pk, 'pendidikan');

//data pendikan
$m = 1;
foreach ($pekerjaan as $pk) {
  $pkr[$m] = [
    'jumlah'            => $pk['jumlah'],
    'pekerjaan'         => $pk['pekerjaan']
  ];
  $m++;
}
$j_pek     = array_column($pkr, 'jumlah');
$l_pek     = array_column($pkr, 'pekerjaan');
?>

<script>
 var options = {
  title : {text : 'Statistik Pilihan Responden per kategori soal'},
  chart: {
    type: 'bar'
  },
  series: [{
    name: 'Mutu',
    data: <?php echo json_encode($kepuasan) ?>
  }],
  xaxis: {
    categories: <?php echo json_encode($id_soal) ?>
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render(); 


/*pie chart pendidikan*/
var options = {
  title : {text : 'responden berdasarkan pendidikan' },
  series: <?php echo json_encode($j_pend) ?>,
  chart: {
    width: 380,
    type: 'pie',
  },
  labels: <?php echo json_encode($l_pend) ?>,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#piepend"), options);
chart.render();

/*pie chart pekerjaan*/
var options = {
  title : {text : 'responden berdasarkan pekerjaan' },
  series: <?php echo json_encode($j_pek) ?>,
  chart: {
    width: 380,
    type: 'pie',
  },
  labels: <?php echo json_encode($l_pek) ?>,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#piepekerjaan"), options);
chart.render();
</script>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
      type: 'column',
      backgroundColor: 'transparent'
    },
    title: {
      text: 'Statistik Kepuasan Masyarakat'
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
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Index Kepuasan'
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
          color: '#150485',
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