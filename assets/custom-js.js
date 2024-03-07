let base_url = $("#base_url").data("id");

/* CARD */
$.ajax({
  url: base_url + "survey/visitor",
  type: "get",
  dataType: "json",
})
  .done(function (data) {
    $("#count_responden").text(parseInt(data.responden).toLocaleString("en"));
    $("#count_loket").text(data.loket.toLocaleString("en"));
    $("#nilai_kepuasan").text(data.nilai_kepuasan);
    $("#tingkat_kepuasan").text(data.tingkat_kepuasan);
    $("#visitor_now").text(parseInt(data.now).toLocaleString("en"));
    $("#visitor_all").text(parseInt(data.all).toLocaleString("en"));
  })
  .fail(function () {
    console.log("error");
  });

/* CHART PILIHAN */
$.ajax({
  type: "get",
  url: `${base_url}get-chart-pie`,
  dataType: "json",
  success: function (response) {
    var options = {
      series: response.persen,
      chart: {
        width: 480,
        type: "pie",
      },
      legend: {
        position: "bottom",
      },
      labels: response.label,
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 300,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    };

    var chart = new ApexCharts(document.querySelector("#pie"), options);
    chart.render();
  },
});

/* CHART PENDIDIKAN */
$.ajax({
  type: "get",
  url: `${base_url}get-chart-pend`,
  dataType: "json",
  success: function (response) {
    var options = {
      series: response.data,
      chart: {
        width: 400,
        type: "pie",
      },
      labels: response.label,
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 300,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    };

    var chart = new ApexCharts(document.querySelector("#piepend"), options);
    chart.render();
  },
});

/* PIE PEKERJAAN */
$.ajax({
  type: "get",
  url: `${base_url}get-chart-pek`,
  dataType: "json",
  success: function (response) {
    var options = {
      series: response.data,
      chart: {
        width: 400,
        type: "pie",
      },
      labels: response.label,
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 300,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    };

    var chart = new ApexCharts(document.querySelector("#piepek"), options);
    chart.render();
  },
});

/* COLUMN CHART KATEGORI */
$.ajax({
  type: "get",
  url: `${base_url}get-chart-kategori`,
  dataType: "json",
  success: function (response) {
    var options = {
      title: {
        text: "Statistik Pilihan Responden per kategori soal",
      },
      chart: {
        type: "bar",
      },
      series: [
        {
          name: "Mutu",
          data: response.data,
        },
      ],
      xaxis: {
        categories: response.label,
      },
    };
    var chart = new ApexCharts(
      document.querySelector("#chart-kategori"),
      options
    );
    chart.render();
  },
});

/* TABLE MUTU */
$("#body-mutu").html("");
$.ajax({
  type: "get",
  url: `${base_url}get-table-mutu`,
  dataType: "json",
  success: function (response) {
    $("#body-mutu").html(response.data);
  },
});
