<style>
.word {
    font-size: 2em;
    fill: steelblue;
    position: absolute;
}
#canvas-chart-sentiments {
    width: 100% !important;
    height: 100% !important;
}

.card-body .chart-total-sentiments {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1em;
    font-weight: 600;
}
.big-number {
    font-size: 50px;
    font-weight: bold;
}
</style>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
        <div class="card-body position-relative" style="background: var(--bs-green-100);">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-flex align-items-center mb-7">
                <div class="rounded-circle overflow-hidden me-6">
                  <!-- @if(auth()->user()->photo != null) -->
                    <!-- <img src="{{ auth()->user()->photo }}" class="rounded-circle" width="40" height="40" alt="" /> -->
                  <!-- @else -->
                    <img src="<?= base_url('assets/images/default_profile.png') ?>" class="rounded-circle" width="40" height="40" alt="" />
                  <!-- @endif -->
                </div>

                <h5 class="fw-semibold mb-0 ms-3 fs-5">Selamat Datang <?= $name ?>!</h5>
              </div>
              <div class="d-flex align-items-center">

                <div class="ps-4">
                  <div class="w-100 d-flex justify-content-center">
                      <img class="w-100 aquamarin-invert" id="weatherIcon" src="" alt="Weather Icon" />
                  </div>
                </div>

                <div class="border-end pe-4 border-muted border-opacity-10">
                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="description">-</h3>
                  <p class="mb-0 text-dark">Kondisi Cuaca</p>
                </div>
                
                <div class="ps-4">
                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="temperature">0˚C</h3>
                  <p class="mb-0 text-dark">Temperatur</p>
                </div>

                <div class="ps-4">
                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="windSpeed">0 m/s</h3>
                  <p class="mb-0 text-dark">Kecepatan Angin</p>
                </div>

                <div class="ps-4">
                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="pressure">0 hPa</h3>
                  <p class="mb-0 text-dark">Tekanan Udara</p>
                </div>

                <div class="ps-4">
                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="humidity2">0 %</h3>
                  <p class="mb-0 text-dark">Kelembapan</p>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="welcome-bg-img mb-n7 text-end">
                <!-- <img src="../assets/images/backgrounds/welcome-bg.svg" alt="" class="img-fluid"> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 d-flex align-items-stretch d-none">
      <div class="w-100">
        <h5>TOTAL TIPE TERMINAL</h5>
      </div>
    </div>
    <div class="col-md-12 d-none">
      <div class="row">
          <div class="col-sm-6 col-xl-3">
              <div class="card modalDetailTipeTerminal" data-tipe="A" style="cursor: pointer;">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center">
                  <h5 class="mb-0"><i class="fa-solid fa-square-share-nodes"></i> TERMINAL TIPE A</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">
                    <h3 class="mb-0 fw-semibold fs-7" id="count-total-terminal-tipe-a">0</h3>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="card modalDetailTipeTerminal" data-tipe="B" style="cursor: pointer;">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center">
                  <h5 class="mb-0"><i class="fa-solid fa-square-share-nodes"></i> TERMINAL TIPE B</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">
                    <h3 class="mb-0 fw-semibold fs-7" id="count-total-terminal-tipe-b">0</h3>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="card modalDetailTipeTerminal" data-tipe="C" style="cursor: pointer;">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center">
                    <h5 class="mb-0"><i class="fa-solid fa-square-share-nodes"></i> TERMINAL TIPE C</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">
                    <h3 class="mb-0 fw-semibold fs-7" id="count-total-terminal-tipe-c">0</h3>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="card modalDetailTipeTerminal" data-tipe="-" style="cursor: pointer;">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center">
                    <h5 class="mb-0"><i class="fa-solid fa-square-share-nodes"></i> TERMINAL TIPE LAINNYA</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">
                    <h3 class="mb-0 fw-semibold fs-7" id="count-total-terminal-tipe-lainnya">0</h3>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card" data-sr-id="13" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <div class="row row-sm">
            <div class="col-12">
              <a href="<?= base_url('main/dashboard_kendaraan'); ?>" target="_blank" class="text-muted">
                <h3>
                <i class="fa-solid fa-map-location-dot"></i>
                  Menuju Dashboard Kendaraan
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                      <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </h3>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
        <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
            <div class="card-body" style="padding: 10px;">
                <div class="row row-sm">
                    <div class="col-4">
                      <center>
                        <div class="ps-4">
                          <h3 id="totalPerusahaan">500</h3>
                          <p class="mb-0 text-dark">Total Perusahaan</p>
                        </div>
                      </center>
                    </div>
                    <div class="col-4">
                      <center>
                        <div class="ps-4">
                          <h3 id="gpsSerialNumbser">1.500</h3>
                          <p class="mb-0 text-dark">GPS Serial Number</p>
                        </div>
                      </center>
                    </div>
                    <div class="col-4">
                      <center>
                        <div class="ps-4">
                          <h3 id="nomorKendaraan">1.000</h3>
                          <p class="mb-0 text-dark">Nomor Kendaraan</p>
                        </div>
                      </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
      <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <h4>Perusahaan</h4>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <h4>DETAIL GPS</h4>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <h4>Sender GPS</h4>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <h4>Route Type</h4>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card" data-sr-id="33" style="visibility: visible; transform: none; opacity: 1; transition: none;">
        <div class="card-body">
          <h4>Active GPS Per Day</h4>
        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalDetailTipeTerminal" tabindex="-1" aria-labelledby="modalDetailTipeTerminalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalDetailTipeTerminalLabel">Data Terminal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body" style="max-height: 45rem; overflow-y: auto;">
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-wordcloud"></script>

<script>
    var apiKeyOpenWeather = "05d975a2c9b634efb6bc57789b02f8bc";
    var urlApi = `<?= base_url('api'); ?>`;
    
    // cuaca
    async function showWeather() {
        Swal.showLoading();
        const city = `<?= getenv("prop.DEFAULT_CITY") ?>`;
        let latOpenWeather = `<?= getenv("prop.DEFAULT_LATITUDE") ?>`; // "-7.446998";
        let longOpenWeather = `<?= getenv("prop.DEFAULT_LONGITUDE") ?>`; // "112.214311";
        let urlOpenWeather = 'https://api.openweathermap.org/data/2.5/weather?lat='+latOpenWeather+'&lon='+longOpenWeather+'&appid='+apiKeyOpenWeather+'&units=metric&lang=id';

        $("#city").text(city);

        $.ajax({
            url: urlOpenWeather,
            method: "GET",
            success: function(data) {
                $("#temperature").text(data.main.temp + ' °C');
                $("#windSpeed").text(data.wind.speed + ' m/s');
                $("#pressure").text(data.main.pressure + ' hPa');
                $("#humidity2").text(data.main.humidity + ' %');
                $("#description").text(data.weather[0].description);
                var iconCode = data.weather[0].icon;
                var iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
                $("#weatherIcon").attr("src", iconUrl);
                Swal.close();
            },
            error: function(error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal Memuat Cuaca",
                    text: "Kota tidak ditemukan!",
                });
                $("#weatherInfo").hide();
                Swal.close();
            },
        });
    }
    // end cuaca

    async function getTotalTerminalByTipe() {
        let resp = await getData(`${urlApi}/data-terminal`);
        if(resp.status_code == 200) {
            let data = resp.data;
            let countTipeA = data.filter(item => (item.terminal_type).toUpperCase() === 'A').length;
            let countTipeB = data.filter(item => (item.terminal_type).toUpperCase() === 'B').length;
            let countTipeC = data.filter(item => (item.terminal_type).toUpperCase() === 'C').length;
            let countTipeLainnya = data.filter(item => !['A', 'B', 'C'].includes((item.terminal_type).toUpperCase())).length;

            $("#count-total-terminal-tipe-a").text(countTipeA);
            $("#count-total-terminal-tipe-b").text(countTipeB);
            $("#count-total-terminal-tipe-c").text(countTipeC);
            $("#count-total-terminal-tipe-lainnya").text(countTipeLainnya);
        }
    }

    async function showModalDetailTipeTerminal() {
        await $(document).on('click', '.modalDetailTipeTerminal', async function() {
            let tipe = $(this).data('tipe');
            let resp = await getData(`${urlApi}/data-terminal?tipe=${tipe}`);
            if(resp.status_code == 200) {
                let data = resp.data;
                let html = '';
                data.forEach(item => {
                    if (item.terminal_type.toUpperCase() === tipe) {
                        html += `
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">${item.terminal_name}</h5>
                                            <p class="card-text">Terminal Type: ${item.terminal_type}</p>
                                            <p class="card-text">Terminal Code: ${item.terminal_code}</p>
                                            <p class="card-text">Terminal Address: ${item.terminal_address} ${item.terminal_city_name}</p>
                                            <p class="card-text">Terminal Longitude: ${item.terminal_lat ? item.terminal_lat : 'N/A'}</p>
                                            <p class="card-text">Terminal Longitude: ${item.terminal_lng ? item.terminal_lng : 'N/A'}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                });
                $("#modalDetailTipeTerminal .modal-body").html(html);
                $("#modalDetailTipeTerminal").modal('show');
            }
        });
    }

    async function getData(url) {
        Swal.showLoading();
        var settings = {
            "url": url,
            "method": "GET",
            "timeout": 0,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        let data = await $.ajax(settings);
        Swal.close();
        return data;
    }

    $(document).ready(async function() {
        await showWeather();
        // await getTotalTerminalByTipe();
        // await showModalDetailTipeTerminal();
        //   showUserActiveComment();
        //   showSentiments();
        //   getTotalUserComment();
        //   await getListData(defaultLimitPage, currentPage, defaultAscending, '');
    });

</script>