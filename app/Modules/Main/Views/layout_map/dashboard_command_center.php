<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Dashboard Command Center</title>
    <link rel="icon" type="image/png" href="//ppdbjatim.net/images/logo.png">
    <link rel="apple-touch-icon" href="//ppdbjatim.net/images/logo.png">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open Sans:wght@300;400;500;600;800&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" />

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" />
    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css"  />
    <!-- Leaflet.MarkerCluster -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />
    
    <!-- custom -->
    <link rel="stylesheet" href="<?= base_url('assets/hud') ?>/preloader.css" />
    <link rel="stylesheet" href="<?= base_url('assets/hud') ?>/slider.css" />
    <link rel="stylesheet" href="<?= base_url('assets/hud') ?>/global.css" />
    <link rel="stylesheet" href="<?= base_url('assets/hud') ?>/index.css" />

    <style>
      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        /* z-index: 2; */
      }
      #context-menu {
          position: absolute;
          display: none;
          background: white;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
          z-index: 10;
          padding: 10px;
          border-radius: 4px;
      }
      
      #context-menu ul {
          list-style: none;
          margin: 0;
          padding: 0;
      }
      
      #context-menu li {
          padding: 8px 12px;
          cursor: pointer;
      }
      
      #context-menu li:hover {
          background: #f0f0f0;
      }
      /* custom */

      .noty_theme__mint.noty_type__success {
            background-color: #fff;
            border-bottom: 1px solid #2addac;
            color: #252525;
        }
        
        .form-check-input:checked {
            background-color: #16c792;
            border-color: #00ffb4;
        }

        .bg-info-subtle {
            background-color: #e0f7fa;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .ui-autocomplete-loading {
            background: white url("https://jqueryui.com/resources/demos/autocomplete/images/ui-anim_basic_16x16.gif") right center no-repeat;
        }

        .ui-widget.ui-widget-content {
            border: 1.5px solid #00ffbb;
            background: #252525;
            opacity: 80%;
            color: #00ffbb;
            border-radius: 5px;
            padding: 2px;
        }

        input#txtsearch {
            background: transparent;
            color: #0bf7b9;
        }

        .popup-bus {
            /* width: 9rem; */
            /* height: 5rem; */
            color: aquamarine;
        }

        .maplibregl-popup-close-button {
            right: 10px;
            color: #00D1D1;
        }

        .maplibregl-popup-anchor-bottom .maplibregl-popup-tip {
            color: aquamarine;
            border-top-color: aquamarine;
            margin-bottom: 2rem;
        }
        
        .maplibregl-popup-content {
            background: #2525258c;
            border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
            padding: 15px 10px;
            pointer-events: auto;
            position: relative;
            color: #0cfbbc;
            border: 1px solid #13e9b3;
        }

        .dropdown-menu.p-2.show {
            background:rgb(255, 255, 255);
            opacity: 85%;
            color: #11fabb;
            border: 1px solid #11fabb;
        }
        
        .videoCentered {
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        video:not([data-controls-visible='true']) .vjs-control-bar {
            display: none;
        }

        ::placeholder {
            color: #7FFFD4;
        }

        ::-ms-input-placeholder {
            color: #7FFFD4;
        }

        a.list-group-item.list-group-item-action:hover {
            background: #7efcd3;
            opacity: 80%;
            color: black;
        }

        a.list-group-item.list-group-item-action {
            background: transparent;
            color: aquamarine;
            border: 1px solid;
        }

        .btn-balas-a{
                display: none;
            }

        .btn-balas-b{
                display: block;
            }

        .modal-title{
                font-size:25px;
            }

        .mb-3{
                margin-bottom: 1rem !important;
            }
        
        .dropdown-menu{
                top: -40% !important;
                margin-left: 1rem !important;
                width: 20rem !important;
        }

        .aquamarine-border {
            width: 100%;
            border: 2px solid aquamarine !important;
            border-collapse: collapse;
            background-color: transparent !important;
        }
        .aquamarine-border th, .aquamarine-border td {
            border: 1px solid aquamarine;
            outline: solid 1px;
            padding: 8px;
        }
        .aquamarine-border th, tbody{
            color: aquamarine !important;
        }

        @media screen and (max-width: 1440px) {
            body{
                font-size: 12px;
            }

            .mapboxgl-ctrl-geocoder{
                scale: 0.8 !important;
            }

            .swiper-slide .card{
                height: 50% !important;
            }

            .swiper-slide table{
                scale: 1 !important;
            }

            .swiper{
                height: 4rem !important;
            }

            .side-menu-b .card{
                font-size: 12px;
                width: 100% !important;
                height: 50% !important;
                overflow: hidden;
            }

            video{
                height: 7rem !important;
            }

            .card{
                font-size: 12px;
                width: 100% !important;
                height: 100% !important;
                overflow: hidden;
            }

            .side-menu-b, .side-menu-a{
                scale: 1 !important;
                overflow: hidden !important;
            }

            .side-menu-b img{
                scale: 0.8 !important;
                margin-left: 0rem !important;
                margin-right: 0rem !important;
            }

            .side-menu-a img{
                scale: 0.8 !important;
                margin-left: 0rem !important;
                margin-right: 0rem !important;
            }

            footer img{
                scale: 0.6 !important;
                margin-left: 0rem !important;
                margin-right: 0rem !important;
            }

            footer{
                scale: 1 !important;
            }

            footer .card{
                width: 14rem !important;
            }

            .carousel-inner{
                width: 100% !important;
            }

            .btn-balas-a{
                display: block;
            }

            .btn-balas-b{
                display: none;
            }

            .menu-bt{
                position: absolute;
                right: -5rem;
                bottom: 1rem;
            }

            .modal-title{
                font-size:30px;
            }

            .hr-2-lg {
                background-color: aquamarine;
                height: 0.1rem;
                position: absolute;
                left: -10rem;
                top: -2rem;
                transition: 2s;
                animation: hr2-animation-lg 2s forwards;
            }

            .mapboxgl-ctrl-geocoder{
                top: -1.5rem;
            }

            .mb-3{
                margin-bottom: 0rem !important;
            }

            .mds img{
                scale: 1 !important;
            }
        }
        
    </style>
  </head>
  <body>
    <!-- Preloader -->
    <?= view('App\Modules\Main\Views\layout_map\preloader') ?>

    <main class="dashboard" id="dashboard">
      <!-- <div id="map"></div> -->
      <div class="contact-details__map-box">
        <div id="map"></div>
        <div class="card bg-default" id="context-menu">
            <ul>
                <span id="create-route" style="display: none; cursor: pointer;">Buat Jalan</span>
                <span id="add-marker" style="cursor: pointer;">Tambah Titik Traffic Jalan </span>
                <!-- <span id="add-cctv">Tambah Titik CCTV</span> -->
                <span id="delete-point" style="display: none; cursor: pointer;">Hapus Titik</span>
            </ul>
        </div>
      </div>
      
      <header class="navbar-top-center" id="head">
        <div class="title-head">
          <div class="head-dashboard">
            <div class="date-and-time">
              <div class="date">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/calendardots.svg"
                />
  
                <div class="sabtu-01-juni"><span id="tanggal">Sabtu, 01 juni 2024</span></div>
              </div>
              <div class="date">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/clock.svg"
                />
  
                <div class="sabtu-01-juni"><span id="jam">15:00:12</span></div>
              </div>
            </div>
            <div class="text-dashboard">
              <img
                class="text-dashboard-child"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/dashboard.svg"
              />

              <div class="dashboard1">Command Center</div>
              <img class="spread-icon" alt="" src="<?= base_url('assets/hud') ?>/public/spread.svg" />
            </div>
            <div class="head">
              <img class="house-icon" alt="" src="<?= base_url('assets/hud') ?>/public/house.svg" />

              <div class="home">Home</div>
              <div class="home">/</div>
              <div class="home">Dashboard</div>
            </div>
          </div>
        </div>
        <div class="field-search" style="border: solid 1px #00f7f1;">
          <img
            class="house-icon"
            alt=""
            src="<?= base_url('assets/hud') ?>/public/iconamoonsearchbold.svg"
          />

          <input class="cari" type="search" id="txtsearch" placeholder="Cari"/>
        </div>
      </header>
      
      <footer class="footer" id="footer">
        <div class="container9">
          <div class="live-streaming">
            <div class="head-text">
              <div class="info-perangkat">info perangkat</div>
              <img
                class="head-text-child"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/group-1.svg"
              />
            </div>
            <div class="container2">
              <div class="container3">
                <div class="text">
                  <div class="info-perangkat">45</div>
                  <div class="info-perangkat">dns</div>
                </div>
                <img class="icon" alt="" src="<?= base_url('assets/hud') ?>/public/icon.svg" />
              </div>
              <div class="container3">
                <div class="text">
                  <div class="info-perangkat">12</div>
                  <div class="info-perangkat">dms</div>
                </div>
                <img class="icon" alt="" src="<?= base_url('assets/hud') ?>/public/icon.svg" />

                <div class="text">
                  <div class="info-perangkat">110</div>
                  <div class="info-perangkat">vid</div>
                </div>
              </div>
            </div>
          </div>
          <div class="container5">
            <div class="head-text">
              <div class="info-perangkat">Tipe simpang</div>
              <img
                class="head-text-child"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/group-1.svg"
              />
            </div>
            <div class="container6">
              <div class="icon2">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/bisignintersectionside1.svg"
                />

                <div class="text3">
                  <div class="jumlah-penindakan">Simpang 5</div>
                  <div class="div4">1</div>
                </div>
              </div>
              <div class="icon2">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/bisignintersectionside1.svg"
                />

                <div class="text3">
                  <div class="jumlah-penindakan">Simpang 3</div>
                  <div class="div4">12</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container7">
          <div class="head-text2">
            <div class="info-perangkat">info jembatan timbang</div>
            <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
          </div>
          <div class="live-streaming">
            <div class="data-produksi">data produksi</div>
            <div class="container11">
              <div class="icon2">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/claritydashboardsolid.svg"
                />

                <div class="text3">
                  <div class="jumlah-penindakan">Jumlah penindakan</div>
                  <div class="div4">79.467</div>
                </div>
              </div>
              <div class="icon2">
                <img
                  class="claritydashboard-solid-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/claritydashboardsolid.svg"
                />

                <div class="text3">
                  <div class="jumlah-penindakan">
                    Jumlah tidak ditindak lanjuti
                  </div>
                  <div class="div4">124.642</div>
                </div>
              </div>
            </div>
          </div>
          <div class="live-streaming">
            <div class="data-produksi">Top 5 data produksi UPPKB</div>
            <div class="container11">
              <div class="icon6">
                <div class="text3">
                  <div class="uppkb-kulwaru">UPPKB KULWARU</div>
                  <div class="container-parent">
                    <div class="container3">
                      <div class="container-child"></div>
                      <div class="jumlah-penindakan">penimbangan</div>
                    </div>
                    <div class="jumlah-penindakan">18.872</div>
                  </div>
                  <div class="container-parent">
                    <div class="container13">
                      <div class="container-item"></div>
                      <div class="jumlah-penindakan">pelanggaran</div>
                    </div>
                    <div class="jumlah-penindakan">2.483</div>
                  </div>
                  <div class="container-parent">
                    <div class="container13">
                      <div class="container-inner"></div>
                      <div class="jumlah-penindakan">penindakan</div>
                    </div>
                    <div class="jumlah-penindakan">961</div>
                  </div>
                </div>
              </div>
              <div class="icon6">
                <div class="text3">
                  <div class="uppkb-kulwaru">UPPKB KULWARU</div>
                  <div class="container-parent">
                    <div class="container3">
                      <div class="container-child"></div>
                      <div class="jumlah-penindakan">penimbangan</div>
                    </div>
                    <div class="jumlah-penindakan">18.872</div>
                  </div>
                  <div class="container-parent">
                    <div class="container13">
                      <div class="container-item"></div>
                      <div class="jumlah-penindakan">pelanggaran</div>
                    </div>
                    <div class="jumlah-penindakan">2.483</div>
                  </div>
                  <div class="container-parent">
                    <div class="container13">
                      <div class="container-inner"></div>
                      <div class="jumlah-penindakan">penindakan</div>
                    </div>
                    <div class="jumlah-penindakan">961</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container18">
          <div class="head-text">
            <div class="info-perangkat">ramp check</div>
            <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
          </div>
          <div class="ellipse-parent">
            <div class="frame-child"></div>
            <div class="tahun-2024">Tahun 2024</div>
            <div class="jumlah-kendaraan-yang">
              jumlah kendaraan yang melalui ramp chek:
            </div>
            <div class="div14">31.526</div>
          </div>
          <div class="container19">
            <canvas id="myPieChart" width="50" height="50"></canvas>
            <div class="container20">
              <div class="container-parent">
                <div class="container-inner"></div>
                <div class="jumlah-penindakan">Di izinkan oprasional</div>
              </div>
              <div class="container-parent">
                <div class="container-child4"></div>
                <div class="jumlah-penindakan">Dilarang oprasional</div>
              </div>
              <div class="container-parent">
                <div class="container-child5"></div>
                <div class="jumlah-penindakan">peringatan / perbaikan</div>
              </div>
              <div class="container-parent">
                <div class="container-child6"></div>
                <div class="tilang-dan-dilaran">
                  Tilang dan dilaran oprasional
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      
      <section class="side-left" id="sidebar left">
        <div class="side-left1">
          
          <div class="live-streaming">
            <div class="head-text">
              <div class="live-streaming1">live streaming</div>
              <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
            </div>
            <div class="video-silder">
              <div id="carousel-left" class="carousel carousel-container">
                <div id='item_3' class="prev">
                  <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
                </div>
          
                <div id='item_4' class="selected">
                  <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
                </div>
          
                <div id='item_5' class="next">
                  <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
                </div>
              </div>
              <div class="title-video">
                <div class="simpang-3-proklamasi">Simpang 3 proklamasi</div>
                <img class="shape-iconn" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                <img class="shape-icon" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
              </div>
            </div>
          </div>
          <div class="top-5-terminal">
            <div class="head-text">
              <div class="live-streaming1">Top 5 terminal terpadat</div>
              <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
            </div>
            <div class="info-perangkat">#2 terminal kartanegoro</div>
            <div class="container-count">
              <div class="container25">
                <div class="count">
                  <div class="div16">11.545</div>
                  <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />

                  <div class="jumlah-keberangkatan-penumpang">
                    Jumlah keberangkatan penumpang
                  </div>
                </div>
                <div class="count">
                  <div class="div16">9.966</div>
                  <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                  <div class="jumlah-keberangkatan-penumpang">
                    jumlah kedatangan penumpang
                  </div>
                </div>
              </div>
              <div class="container25">
                <div class="count">
                  <div class="div16">819</div>
                  <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                  <div class="jumlah-keberangkatan-penumpang">
                    Jumlah bus datang
                  </div>
                </div>
                <div class="count">
                  <div class="div16">834</div>
                  <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                  <div class="jumlah-keberangkatan-penumpang">
                    Jumlah bus berangkat
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="top-5-terminal2">
            <div class="head-text2">
              <div class="info-pergerakan-di">
                info pergerakan di terminal per hari
              </div>
              <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
            </div>
            <div class="grafik-pegerakan-pemberangkata">
              Grafik pegerakan pemberangkatan per-hari
            </div>
            <canvas  id="myChart"></canvas>
          </div>
          <div class="top-5-terminal2">
            <div class="grafik-pegerakan-pemberangkata">
              Grafik pegerakan kedatangan per-hari
            </div>
            <canvas  id="myChart2"></canvas>
          </div>
          <!-- <div class="top-5-terminal2">
            <div class="head-text2">
              <div class="info-pergerakan-di">
                info pergerakan di terminal per hari
              </div>
              <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
            </div>
            <div class="grafik-pegerakan-pemberangkata">
              Grafik pegerakan pemberangkatan per-hari
            </div>
            <div class="data-content-parent">
              <div class="data-content">
                <img
                  class="bisign-intersection-side-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/intetity-color-circle.svg"
                />

                <div class="div20">
                  <div class="content">Jumlah bus</div>
                </div>
              </div>
              <div class="data-content1">
                <img
                  class="bisign-intersection-side-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/intetity-color-circle1.svg"
                />

                <div class="div20">
                  <div class="content">Jumlah penumpang</div>
                </div>
              </div>
            </div>
            <div class="chart-line">
              <img
                class="chart-line-child"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/frame-2390.svg"
              />

              <div class="index-wrapper">
                <div class="index">
                  <div class="chart">
                    <div class="chart1">
                      <div class="number">
                        <div class="wrapper">
                          <div class="div22">1,0</div>
                        </div>
                        <div class="wrapper">
                          <div class="div22">0,8</div>
                        </div>
                        <div class="wrapper">
                          <div class="div22">0,6</div>
                        </div>
                        <div class="wrapper">
                          <div class="div22">0,4</div>
                        </div>
                        <div class="wrapper">
                          <div class="div22">0,2</div>
                        </div>
                        <div class="wrapper4">
                          <div class="div27">0</div>
                        </div>
                      </div>
                    </div>
                    <div class="mon">
                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2347@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2348@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2349@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2350@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2352@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2351@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2353@2x.png"
                      />

                      <img
                        class="mon-child"
                        alt=""
                        src="<?= base_url('assets/hud') ?>/public/frame-2354@2x.png"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="top-5-terminal3">
            <div class="grafik-pegerakan-kedatangan">
              Grafik pegerakan kedatangan per-hari
            </div>
            <div class="data-content-group">
              <div class="data-content">
                <img
                  class="bisign-intersection-side-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/intetity-color-circle.svg"
                />

                <div class="div20">
                  <div class="content">Jumlah bus</div>
                </div>
              </div>
              <div class="data-content1">
                <img
                  class="bisign-intersection-side-icon"
                  alt=""
                  src="<?= base_url('assets/hud') ?>/public/intetity-color-circle1.svg"
                />

                <div class="div20">
                  <div class="content">Jumlah penumpang</div>
                </div>
              </div>
            </div>
            <img class="chart-line-icon" alt="" src="<?= base_url('assets/hud') ?>/public/chartline.svg" />
          </div> -->
        </div>
        <div class="navigasi" id="navigasi">
          <div class="btn-group dropend">
            <button type="button" class="felayer" id="layer" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="vector-icon" alt="" src="<?= base_url('assets/hud') ?>/public/vector.svg" />
            </button>
            
            <ul class="dropdown-menu" style="background-color: #285a58ca; border: solid 1.5px #00f7f1; transform: translate(45px, 0px); width: 200px;">
              <div class="info-perangkat" style="color: #fff; margin-left: 15px; padding-bottom: 10px;">DATA LAYER</div>
              <li>
                <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                cctv
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Detektor
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    </div>
              </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Simpang
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    </div>
              </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Lokasi UPPKB
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    </div>
              </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Pelabuhan
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    </div>
              </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Terminal Tipe A
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    </div>
              </label>
            </li>
            <li>
              <label class="dropdown-item d-flex justify-content-between align-items-center" style="color: #fff; cursor: pointer;">
                Traffic Flow
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    </div>
              </label>
            </li>
            </ul>
          </div>
          <div class="btn-group dropend">
            <button type="button" class="icround-menu" id="menu" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="vector-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/vector1.svg" />
            </button>
            
            <ul class="dropdown-menu" style="background-color: #285a58ca; border: solid 1.5px #00f7f1; transform: translate(45px, 0px);">
              <div class="info-perangkat" style="color: #fff; margin-left: 15px; padding-bottom: 10px;">OVERVIEW</div>
              <li><a class="dropdown-item" href="#" style="color: #fff;">AtMS Simpang</a></li>
              <li><a class="dropdown-item" href="#" style="color: #fff;">AtMS Ruas Jalan</a></li>
              <li><a class="dropdown-item" href="#" style="color: #fff;">JTO</a></li>
              <li><a class="dropdown-item" href="#" style="color: #fff;">Pelabuhan</a></li>
              <li><a class="dropdown-item" href="#" style="color: #fff;">Terminal</a></li>
              <li><a class="dropdown-item" href="#" style="color: #fff;">Live Streaming</a></li>
            </ul>
          </div>
          
        </div>
      </section>

      <section class="side-right" id="sidebar right">
        <div class="date-and-time1">
          <div class="date1">
            <img
              class="claritydashboard-solid-icon"
              alt=""
              src="<?= base_url('assets/hud') ?>/public/calendardots.svg"
            />
            <div class="sabtu-01-juni"><span id="tanggal">Sabtu, 01 juni 2024</span></div>
          </div>
          <div class="date1">
            <img
              class="claritydashboard-solid-icon"
              alt=""
              src="<?= base_url('assets/hud') ?>/public/clock.svg"
            />
            <div class="sabtu-01-juni"><span id="jam">15:00:12</span></div>
          </div>
        </div>
        <div class="live-streaming2">
          <div class="head-text">
            <div class="info-perangkat">Kinerja ruas jalan</div>
            <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
          </div>
          <div class="video-silder">
            <div id="carousel-right" class="carousel carousel-container">
              <div id='item_3' class="prev">
                <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
              </div>
              <div id='item_4' class="selected">
                <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
              </div>
              <div id='item_5' class="next">
                <video src="http://stream.cctv.malangkota.go.id/WebRTCApp/streams/886421518518743577298499.m3u8?token=null" controls autoplay></video>
              </div>
            </div>
            <div class="title-video">
              <div class="simpang-3-proklamasi">TTD Bulakamba a</div>
              <img class="shape-iconn" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
              <img class="shape-icon" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
            </div>
          </div>
        </div>
        <div class="top-5-terminal4">
          <div class="container18">
            <div class="container25">
              <div class="count">
                <div class="div16">68.70</div>
                <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                <div class="jumlah-keberangkatan-penumpang">
                  kecepatan rata-rata (km/jam)
                </div>
              </div>
              <div class="count">
                <div class="div16">1.529.00</div>
                <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                <div class="jumlah-keberangkatan-penumpang">
                  arus lalu lintas (sMP)
                </div>
              </div>
            </div>
            <div class="container25">
              <div class="count">
                <div class="div16">5.692,96</div>
                <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                <div class="jumlah-keberangkatan-penumpang">kapasitas</div>
              </div>
              <div class="count">
                <div class="div16">0,27</div>
                <img class="shape-icon1" style="top: 5px;" alt="" src="<?= base_url('assets/hud') ?>/public/circle.gif" />
                  <img class="shape-icon1" alt="" src="<?= base_url('assets/hud') ?>/public/circle-svg.svg" />
                <div class="jumlah-keberangkatan-penumpang">v/c rasio</div>
              </div>
            </div>
          </div>
        </div>
        <div class="top-5-terminal2">
          <div class="grafik-pegerakan-pemberangkata">
            Grafik v/c per hari ini
          </div>
            <canvas  id="myChart3" style="width: 200px;"></canvas>
          </div>
        </div>
        <div class="container29">
          <div class="head-text">
            <div class="info-perangkat">info pelabuhan hari ini</div>
            <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
          </div>
          <div class="container11">
            <div class="icon8">
              <img class="house-icon" alt="" src="<?= base_url('assets/hud') ?>/public/usersthree.svg" />

              <div class="text3">
                <div class="jumlah-penindakan">Keberangkatan (penumpang)</div>
                <div class="div42">9.479</div>
              </div>
            </div>
            <div class="icon8">
              <img class="house-icon" alt="" src="<?= base_url('assets/hud') ?>/public/usersthree.svg" />

              <div class="text3">
                <div class="jumlah-penindakan">Keberangkatan (penumpang)</div>
                <div class="div42">9.479</div>
              </div>
            </div>
          </div>
        </div>
        <div class="container29">
          <div class="head-text">
            <div class="info-perangkat">info terminal hari ini</div>
            <img class="head-text-child" alt="" src="<?= base_url('assets/hud') ?>/public/group-1.svg" />
          </div>
          <div class="container11">
            <div class="icon8">
              <img
                class="arrowupright-icon"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/arrowupright.svg"
              />

              <div class="text3">
                <div class="jumlah-penindakan">kedatangan (penumpang bus)</div>
                <div class="div42">9.479</div>
              </div>
            </div>
            <div class="icon8">
              <img
                class="arrowupright-icon"
                alt=""
                src="<?= base_url('assets/hud') ?>/public/arrowupright.svg"
              />

              <div class="text3">
                <div class="jumlah-penindakan">kedatangan (penumpang bus)</div>
                <div class="div42">9.479</div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <?= view('App\Modules\Main\Views\layout_map\dashboard_command_center_modal') ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= base_url('assets/hud/slider.js') ?>"></script> -->
    <!-- map -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://gps.brtnusantara.com/dev/assets/gps/plugins/custom/Leaflet.encoded/Polyline.encoded.js"></script>
    <script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.js"></script>
    <script src="<?= base_url('assets/hud/togeojson.js') ?>"></script>
    <!-- geo -->
    <script src="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/maptilersdk.umd.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/style.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>
    
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
   
    <script>
      let apiUrl = `<?= base_url('api'); ?>`; //`<?= getenv('prop.BASE_URL_NGI_GPS'); ?>`;
      let apiKeyOpenWeather = "05d975a2c9b634efb6bc57789b02f8bc";
      // let apiKeyMapTiler = '5rM7zwTDoYg0V4s0NsSP';
      let apicuaca = '05d975a2c9b634efb6bc57789b02f8bc'
      let appIdHere = 'eNLj4VUoPM5JlDQOdi6o';
      let apiKeyMapTiler = 'sE1SyP9yF4U9lB4KDB3Q';
      let apiKeyTt = 'SP7myPr3VjGflAgAcFn0VsYsm8v3axNW';
      let defaultLatitude = `<?= getenv("prop.DEFAULT_LATITUDE") ?>`;
      let defaultLongitude = `<?= getenv("prop.DEFAULT_LONGITUDE") ?>`;
      let defaultCity = `<?= getenv("prop.DEFAULT_CITY") ?>`;
    
      // Pusher
      Pusher.logToConsole = false;
      let pusher = new Pusher('<?= getenv("prop.PUSHER_APP_KEY") ?>', {
          cluster: '<?= getenv("prop.PUSHER_APP_CLUSTER") ?>'
      });
      // socket
      let baseUrlNgiGps = `<?= getenv('prop.BASE_URL_NGI_GPS') ?>:8448`;
      let socket = io(baseUrlNgiGps,{secure:true,transports : ['websocket']});
      socket.on("connection", (socket) => {
          console.info(socket.handshake.headers);
      });
      socket.on("disconnect", () => {
        console.info("Koneksi ke server Socket.IO terputus");
      });

      // Preloader
      document.addEventListener("DOMContentLoaded", function() {
        const preloader = document.getElementById("loading");
        const svgFrame = document.querySelector(".svg-frame");

        setTimeout(function() {
            preloader.style.display = "none";
            svgFrame.style.display = "block";
        }, 5000);
      });

      let audioPlayer = new Audio('<?= base_url("assets/hud/audio/ringtone-wa.mp3") ?>');
      let map, markers = {}, theMarkers = [];
      theMarkers['terminal'] = [];
      theMarkers['fasilitas'] = [];
      theMarkers['bus'] = [];
      theMarkers['ruteBus'] = [];
      theMarkers['trafficFlow'] = [];
      theMarkers['trafficFlowGoogleMarker'] = [];
      theMarkers['fromAddRouteMarker'] = [];
      theMarkers['fromAddRouteWithDetail'] = [];

      // init map
      maptilersdk.config.apiKey = apiKeyMapTiler;
      map = new maptilersdk.Map({
          container: 'map', // container's id or the HTML element to render the map
          style: maptilersdk.MapStyle.STREETS.DARK,
          center: [defaultLongitude, defaultLatitude], // starting position [lng, lat]
          zoom: 13, // starting zoom
          pitch: 50,
          bearing: -2,
          maxZoom: 18,
          minZoom: 9,
          navigationControl: false,
          geolocateControl: false
      });
      
      // SEARCH INPUT
      const gc = new maptilersdkMaptilerGeocoder.GeocodingControl({
          types: ['poi']
      });
      // map.addControl(gc, 'top-left');
      map.on('load', function() {
          const userLocation = map.getCenter();
          gc.setOptions({
              proximity: [userLocation.lat, userLocation.lng]
          });
      
          // $('.mapboxgl-ctrl-geocoder').attr('data-aos', 'flip');
          // $('.svelte-1r7dvt7').attr('placeholder', 'Cari lokasi...');
          // $('.svelte-1r7dvt7').removeAttr('placeholder');
          // $('.svelte-1r7dvt7').addClass('bg-transparent text-info rounded-pill');
          // $('.svelte-1r7dvt7').css({
          //     'max-width': '500px',
          //     'width': '500px',
          //     'margin-right': '1.5rem',
          //     'height': '2.5rem',
          // });
      
          
          // $('#toggleTerminalLayerId').on('click', toggleTerminalLayer);
          // $('#toggleJalanLayerId').on('click', toggleJalanLayer);
          // $('#toggleFasilitasLayerId').on('click', toggleFasilitasLayer);
          // $('#toggleBusLayerId').on('click', toggleBusLayer);
          // $('#togglePerlintasanKeretaApiLayerId').on('click', togglePerlintasanKeretaApiLayer);
          // $('#toggleTrafficFlowLayerId').on('click', toggleTrafficFlowLayer);
      });
      // END SEARCH
      
      // document.getElementById('button-addon2').addEventListener('click', function() {
      //     const searchQuery = document.getElementById('txtsearch').value;
      //     if (searchQuery) {
      //         searchPlace(searchQuery);
      //     }
      // });
      
      async function searchPlace(query) {
          const url = `https://api.maptiler.com/geocoding/${encodeURIComponent(query)}.json?key=${apiKey}`;
      
          try {
              const response = await fetch(url);
              const data = await response.json();
      
              if (data.features && data.features.length > 0) {
                  const place = data.features[0];
                  const [lng, lat] = place.geometry.coordinates;
      
                  // Center the map on the searched place
                  map.setCenter([lng, lat]);
                  map.setZoom(15);
      
                  // Optionally, add a marker to the searched place
                  new maptilersdk.Marker().setLngLat([lng, lat]).addTo(map);
              } else {
                  alert('Place not found');
              }
          } catch (error) {
              console.error('Error searching for place:', error);
              alert('An error occurred while searching for the place');
          }
      }

      // load data map
      map.on('load', async function() {
          let layersStyle = map.getStyle().layers;
          layersStyle.forEach(function(layer) {
              
              if (layer.id.includes('City labels') 
                  || layer.id.includes('Capital city labels')
                  || layer.id.includes('Town labels')
                  || layer.id.includes('State labels')
                  || layer.id.includes('Place labels')
                  || layer.id.includes('Highway')
              ) {
                  map.setLayoutProperty(layer.id, 'visibility', 'none');
              }
          });
      });
        
      let trafficChart;

      let today = new Date();
      let day = String(today.getDate()).padStart(2, "0");
      let month = String(today.getMonth() + 1).padStart(2, "0");
      let year = today.getFullYear();
      let formattedDate = day + "-" + month + "-" + year;

      let rotationAngle = 1;
      let rotationInterval;
      let isMouseMoving = false;
      let mouseMoveTimeout;
      let clickLngLat;
      let cctvPopup;
      let points = [];
      const markerLayerId = 'markers';
      const cctvLayerId = 'cctv';
      let routeLayerId = 'route';

      let perlintasanKeretaApiLayerEnabled = true;
      let fasilitasLayerEnabled = true;
      let jalanLayerEnabled = true;
      let terminalLayerEnabled = true
      let busLayerEnabled = true;
      let trafficFlowLayerEnabled = true;

      const rotationSpeed = 0.1; // Speed of rotation (degrees per interval)
      const intervalDuration = 100; // Duration of each interval in milliseconds
      let isInteracting = false;

      // rotate map
      let startRotation = () => {
          rotationInterval = setInterval(() => {
              if (!isInteracting) {
                  const currentBearing = map.getBearing();
                  map.setBearing(currentBearing + rotationSpeed);
              }
          }, intervalDuration);
      }

      let stopRotation = () => clearInterval(rotationInterval)

      map.on('load', startRotation);
      ['mousedown', 'mouseup', 'mousemove', 'touchstart', 'touchend', 'wheel'].forEach(event => {
          map.on(event, () => {
              isInteracting = true;
              stopRotation();

              clearTimeout(map.interactionTimeout);
              map.interactionTimeout = setTimeout(() => {
                  isInteracting = false;
                  startRotation();
              }, 8000);
          });
      });
      // end rotate

      // date
      document.getElementById("tanggal").textContent = formattedDate;
      let updateClock = () => {
          var now = new Date();
          var hours = String(now.getHours()).padStart(2, "0");
          var minutes = String(now.getMinutes()).padStart(2, "0");
          var seconds = String(now.getSeconds()).padStart(2, "0");
          var formattedTime = hours + ":" + minutes + ":" + seconds;
          document.getElementById("jam").textContent = formattedTime;
      }
      setInterval(updateClock, 1000);

      // find place on top map
      $( "#txtsearch" ).autocomplete({
          source: function( request, response ) {
              $.ajax( {
                  url: apiUrl + "/find-address",
                  dataType: "json",
                  data: {
                      query: request.term
                  },
                  success: function( data ) {
                      response($.map(data.data, function (el) {
                          return {
                              label: `${el.display_name}`,
                              value: el
                          };
                      }));
                  }
              } );
          },
          minLength: 3,
          select: function( event, ui ) {
              this.value = ui.item.label;
              $(this).next("input").val(ui.item.value);
              let lng = ui.item.value.lon;
              let lat = ui.item.value.lat;
              let lnglat = [lng, lat];
              map.flyTo({
                  center: lnglat,
                  zoom: 17,
                  speed: 1,
                  curve: 1,
                  essential: true
              });
              event.preventDefault();
          },
          open: function(){
              $('.ui-autocomplete').css({
                  'width' : '33.5vh',
                  'margin-top' : '0.5rem',
              });

              $('.ui-menu .ui-menu-item').css({
                  'border-bottom' : '1px solid #18dda8',
              });
          }
      } );

      // fly to map
      $(document).on("click", ".fly-to-map", function() {
          let lng = $(this).attr("data-lng");
          let lat = $(this).attr("data-lat");
          let lnglat = [lng, lat];
          let dataIndex = $(this).attr("data-index");
          let name_marker = $(this).attr("data-name-marker");
          // let id_marker = `${name_marker}_${lnglat.join('_')}`;
          let id_marker = `${name_marker}_${dataIndex}`;

          map.flyTo({
              center: lnglat,
              zoom: 17,
              speed: 1,
              curve: 1,
              essential: true,
              easing(t) {
                  if (t >= 1) {
                      setTimeout(() => {
                          markers[id_marker].togglePopup();
                      }, 550);
                  }
                  return t;
              }
          });

          $("#fasilitasModal").modal("hide");
          $("#jalanModal").modal("hide");
          $("#terminalModal").modal("hide");
      });

      $(document).ready(async function(){
        await showJalan();
        await showFasilitasJalan();
        await showPerlintasanKereta();
      });

      </script>

      <?= view('App\Modules\Main\Views\layout_map\dashboard_command_center_js_draw_map') ?>
      <?= view('App\Modules\Main\Views\layout_map\dashboard_command_center_js_gps') ?>
      <?= view('App\Modules\Main\Views\layout_map\dashboard_command_center_js_custom') ?>

      <script>

      const ctx1 = document.getElementById('myChart').getContext('2d');
      new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1,
            backgroundColor: '#285a58',
              borderColor: '#00f7f1',
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
  
      const ctx2 = document.getElementById('myChart2').getContext('2d');
      new Chart(ctx2, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1,
            backgroundColor: '#285a58',
              borderColor: '#00f7f1',
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
  
      const ctx3 = document.getElementById('myChart3').getContext('2d');
      new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1,
            backgroundColor: '#285a58',
              borderColor: '#00f7f1',
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
  
      const ctx4 = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctx4, {
          type: 'pie',
          data: {
            datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5],
              borderColor: '#fff',
              backgroundColor: [
                '#99FCF9',
                '#66FAF7',
                '#33F9F4',
                '#00F7F1',
              ]
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
              },
            }
          }
        });
    
    </script>
  </body>
</html>
