@extends('layouts.user_type.auth')

@section('content')


  <div class="row mt-4">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Tren Debarkasi Penumpang per Kuartal</h5>
                <select id="filterTahun" class="form-select w-25 mb-3">
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                </select>
                <div id="chartQuarterly" style="width:100%; height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12"> <!-- ubah dari col-lg-6 ke col-lg-12 -->
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Distribusi Debarkasi Penumpang per Tahun</h5>
                <div id="chartStackedPercent" style="width:100%; height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row mt-4">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Jumlah Kecelakaan Per Tahun</h5>
                <div id="chartKecelakaanTahunan" style="width:100%; height:400px;"></div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Top 5 Kabupaten/Kota dengan Jumlah Korban Laka Lantas Meninggal Terbanyak</h5>
                <select id="tahunMeninggal" onchange="loadChartTopMeninggal(this.value)" class="form-select w-25 mb-3">
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                </select>
                <div id="chartTopMeninggal" style="width:100%; height:400px"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Top 5 Kabupaten/Kota berdasarkan Kerugian Materiil</h5>
                <select id="filterTahunKerugian" class="form-select w-25 mb-3">
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                </select>
                <div id="chartKerugian" style="width:100%; height:400px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Jumlah Kendaraan Roda Empat Berdasarkan Jenisnya</h5>
                <div id="chartLineKendaraan" style="width:100%; height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Top 5 Kabupaten/Kota Paling Padat Motor</h5>
                  <select id="tahunFilter" onchange="loadChartTopKepadatanMotor(this.value)" class="form-select w-25 mb-3">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                  </select>
                  <!-- Tempat chart -->
                  <div id="chartTopKepadatanMotor"  style="width:100%; height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Tren Rasio Kecelakaan per Km per Kabupaten/Kota</h5>
                <div id="chartMultipleRasio" style="width:100%; height:350px;"></div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('dashboard')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  function loadChart(tahun) {
    fetch(`/api/chart-quarterly/${tahun}`)
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: { type: 'line', height: 350 },
          series: res.series,
          colors: ['#2C2C54', '#F012BE'], // warna custom untuk tiap series
          xaxis: { 
            categories: res.categories, 
            title: { 
              text: "Kuartal",
              style: {
                fontSize: '13px',
                fontWeight: 'bold',
                fontFamily: 'Open Sans, Arial, sans-serif',
                color: '#1a1a1a'
              }
            },
            labels: {
              style: {
                fontSize: '13px',
                fontFamily: 'Open Sans, Arial, sans-serif',
                colors: ['#495057']
              }
            }
          },
          yaxis: { 
            title: { 
              text: "Jumlah Penumpang"
            },
            labels: {
              style: {
                fontSize: '13px',
                fontFamily: 'Open Sans, Arial, sans-serif',
                colors: ['#495057']
              }
            }
          },
          tooltip: {
            y: { formatter: val => val.toLocaleString() }
          }
        };
        document.querySelector("#chartQuarterly").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartQuarterly"), options);
        chart.render();
      });
  }

  // load default tahun
  loadChart(2020);

  // event filter
  document.getElementById("filterTahun").addEventListener("change", function() {
    loadChart(this.value);
  });

  function loadStackedPercent() {
    fetch(`/api/chart-stacked-percent`)
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: {
            type: 'bar',
            stacked: true,
            height: 400
          },
          series: res.series,
          colors: ['#9b2dfc', '#2c2c54'],
          xaxis: {
            categories: res.categories,
            title: { text: "Tahun" }
          },
          yaxis: {
            max: 100,
            title: { text: "Persentase (%)" },
            labels: { formatter: val => val + "%" }
          },
          tooltip: {
            y: {
              formatter: function (val, opts) {
                let dataPoint = opts.w.config.series[opts.seriesIndex].data[opts.dataPointIndex];
                return val.toFixed(1) + "% (" + dataPoint.jumlah.toLocaleString() + " penumpang)";
              }
            }
          },
          legend: {
            position: 'top',
            horizontalAlign: 'center'
          },
          dataLabels: {
            enabled: false   // << ini kunci biar angka di dalam bar hilang
          }
        };

        document.querySelector("#chartStackedPercent").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartStackedPercent"), options);
        chart.render();
      });
  }
  loadStackedPercent();

  function loadKecelakaanChart() {
    fetch("/api/chart-kecelakaan-tahunan")
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: {
            type: 'bar',
            height: 500
          },
          colors: ["#2c2c54",  "#F012BE", ],          
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '65%',
            }
          },
          dataLabels: { enabled: false },
          stroke: { show: true, width: 2, colors: ['transparent'] },
          xaxis: {
            categories: res.categories,
            title: { text: "Kabupaten/Kota" }
          },
          yaxis: {
            title: { text: "Jumlah Kecelakaan" },
            labels: { formatter: val => val.toLocaleString() }
          },
          tooltip: {
            y: { formatter: val => val.toLocaleString() }
          },
          legend: { position: 'top' },
          series: res.series
        };

        document.querySelector("#chartKecelakaanTahunan").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartKecelakaanTahunan"), options);
        chart.render();
      });
  }

  // Panggil saat halaman load
  loadKecelakaanChart();
  function loadChartTopMeninggal(tahun) {
    fetch(`/api/chart-top-meninggal/${tahun}`)
      .then(r => r.json())
      .then(res => {
        const options = {
          chart: { type: 'bar', height: 350 },
          plotOptions: { bar: { horizontal: true, distributed: true } },
          colors: ["#9b2dfc", "#F012BE", "#495057", "#2c2c54", "#9b2dfc"],
          dataLabels: { enabled: false },              // hilangkan angka di batang
          series: res.series,
          xaxis: {
            categories: res.categories,
            title: { text: "Jumlah Meninggal" }
          },
          tooltip: {
            y: { formatter: v => Number(v).toLocaleString('id-ID') + " jiwa" }
          }
        };

        document.querySelector("#chartTopMeninggal").innerHTML = "";
        new ApexCharts(document.querySelector("#chartTopMeninggal"), options).render();
      })
      .catch(err => console.error(err));
  }

  // load default
  loadChartTopMeninggal(document.getElementById('tahunMeninggal').value);
  function loadChartKerugian(tahun) {
    fetch(`/api/chart-top-kerugian/${tahun}`)
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: { type: 'bar', height: 350 },
          plotOptions: {
            bar: { horizontal: true, distributed: true }
          },
          dataLabels: {
            enabled: false   // << ini kunci biar angka di dalam bar hilang
          },
          colors: ["#2c2c54", "#9b2dfc", "#F012BE", "#495057", "#9b2dfc"],
          series: res.series,
          xaxis: {
            categories: res.categories,
            title: { text: "Kerugian (Rp)" }
          },
          tooltip: {
            y: {
              formatter: val => "Rp " + val.toLocaleString()
            }
          }
        };

        document.querySelector("#chartKerugian").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartKerugian"), options);
        chart.render();
      });
  }

  // load default tahun
  loadChartKerugian(2020);

  // filter event
  document.getElementById("filterTahunKerugian").addEventListener("change", function() {
    loadChartKerugian(this.value);
  });

  function loadChartLineKendaraan() {
    fetch(`/api/chart-line-kendaraan`)
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: { type: 'line', height: 350 },
          series: res.series,
          xaxis: {
            categories: res.categories,
            title: { text: "Tahun" }
          },
          yaxis: {
            title: { text: "Jumlah Kendaraan" }
          },
          stroke: { curve: 'smooth' },
          colors: ["#2c2c54", "#9b2dfc", "#F012BE", "#495057"]
        };

        document.querySelector("#chartLineKendaraan").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartLineKendaraan"), options);
        chart.render();
      });
  }

  loadChartLineKendaraan();
    function loadChartTopKepadatanMotor(tahun) {
      fetch(`/api/chart-top-kepadatan-motor/${tahun}`)
        .then(res => res.json())
        .then(res => {
          console.log(res); // DEBUG lihat JSON
          var options = {
            chart: { type: 'bar', height: 350 },
            plotOptions: { bar: { horizontal: true, distributed: true } },
            colors: ["#2c2c54", "#9b2dfc", "#F012BE", "#495057", "#9b2dfc"],
            series: res.series,
            xaxis: {
              categories: res.categories,
              title: { text: "Kabupaten/Kota" }
            },
            dataLabels: {
              enabled: false
            },
            tooltip: {
              y: {
                formatter: val => val.toFixed(2) + " kendaraan/km (Sepeda Motor)"
              }
            }
          };

          document.querySelector("#chartTopKepadatanMotor").innerHTML = "";
          var chart = new ApexCharts(document.querySelector("#chartTopKepadatanMotor"), options);
          chart.render();
        })
        .catch(err => console.error(err));
    }

    // jalankan default tahun
    loadChartTopKepadatanMotor(2020);
  function loadChartMultipleRasio() {
    fetch(`/api/chart-multiple-rasio`)
      .then(res => res.json())
      .then(res => {
        var options = {
          chart: { type: 'bar', height: 400 },
          plotOptions: {
            bar: { horizontal: false, columnWidth: '50%' }
          },
          dataLabels: { enabled: false },
          series: res.series,
          xaxis: {
            categories: res.categories,
            title: { text: "Kabupaten/Kota" }
          },
          yaxis: {
            labels: {
              formatter: function (val) {
                return val.toFixed(2); // bulatkan jadi integer
              }
            },
            title: {
              text: "Rasio Kecelakaan per Km"
            }
          },
          colors: ["#495057", "#9b2dfc"], // 2 warna untuk 2020, 2021
          legend: { position: 'top' }
        };

        document.querySelector("#chartMultipleRasio").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartMultipleRasio"), options);
        chart.render();
      });
  }

  loadChartMultipleRasio();
</script>


@endpush

