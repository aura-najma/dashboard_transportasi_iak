@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                <h5 class="font-weight-bolder mb-0">
                  2,300
                  <span class="text-success text-sm font-weight-bolder">+3%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                <h5 class="font-weight-bolder mb-0">
                  +3,462
                  <span class="text-danger text-sm font-weight-bolder">-2%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                <h5 class="font-weight-bolder mb-0">
                  $103,430
                  <span class="text-success text-sm font-weight-bolder">+5%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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
                <h5 class="font-weight-bolder">Tren Penumpang per Kuartal</h5>
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
                <h5 class="font-weight-bolder">Distribusi Penumpang per Tahun</h5>
                <div id="chartStackedPercent" style="width:100%; height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row mt-4">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Heatmap Musiman Penumpang</h5>
                  <div id="chartHeatmap" style="width:100%; height:400px;"></div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
                </a>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
                </a>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
                </a>
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
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Judul grafik</h5>
                <p class="mb-5">Keterangan.</p>
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
              text: "Jumlah Penumpang",
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

  function loadHeatmap() {
    fetch(`/api/chart-heatmap`)
      .then(res => res.json())
      .then(series => {
        var options = {
          chart: {
            type: 'heatmap',
            height: 400
          },
          series: series,  // langsung array JSON
          dataLabels: {
            enabled: false
          },
          colors: ["#2c2c54"],
          xaxis: {
            title: {
              text: "Bulan",
              style: { fontSize: '14px', fontWeight: 'bold' }
            }
          },
          yaxis: {
            title: {
              text: "Tahun",
              style: { fontSize: '14px', fontWeight: 'bold' }
            }
          },
          tooltip: {
            y: {
              formatter: val => val.toLocaleString() + " penumpang"
            }
          }
        };

        document.querySelector("#chartHeatmap").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#chartHeatmap"), options);
        chart.render();
      });
  }

  loadHeatmap();
</script>


@endpush

