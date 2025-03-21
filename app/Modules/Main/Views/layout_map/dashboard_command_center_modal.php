
<!-- MODAL DETAIL DATA SIDE A -->
    <!-- cctv modal-->
    <div class="modal fade modal-backdrops" id="detailCctv" tabindex="-1" aria-labelledby="detailCctv" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: none; border:solid 4px aquamarine; border-radius: 2rem;">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center" id="detailCctv" style="color: aquamarine;">CAMERA {{ env('getenv('prop.appname')') }}</h5>
                </div>
                <div class="modal-body overflow-hidden h-100 mt-3" style="border:solid 1px aquamarine; background: #0E172C;">
                    <div class="position-relative overflow-hidden mt-3 h-100" loading="lazy">
                        <iframe class="position-absolute rounded" id="MyCctv" src="" style="width: 100%; height: 100%; border: none; bottom: 4rem;"></iframe>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer; color: aquamarine;">Keluar Halaman</span>
                </div>
            </div>
        </div>
    </div>

    <!-- cuaca modal -->
    <div class="modal fade modal-backdrops" id="cuacaModal" tabindex="-1" aria-labelledby="cuacaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content position-relative align-items-center border-0" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL CUACA</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="w-100 text-center">
                            <strong id="city"></strong>
                        </div>
                        <div id="weatherInfo">

                            <div class="w-100 h-100">
                                <div class="w-100 d-flex justify-content-center">
                                    <img class="w-50 aquamarin-invert" id="weatherIcon2" src="" alt="Weather Icon" />
                                </div>

                                <table style="width: 100%;">
                                    <tr>
                                        <td>Kondisi Cuaca</td>
                                        <td>:</td>
                                        <td><span id="description2"></span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Temperatur saat ini</td>
                                        <td>:</td>
                                        <td><span id="temperature2"></span></td>
                                        <td>°C</td>
                                    </tr>
                                    <tr>
                                        <td>Kecepatan Angin</td>
                                        <td>:</td>
                                        <td><span id="windSpeed2"></span></td>
                                        <td>m/s</td>
                                    </tr>
                                    <tr>
                                        <td>Tekanan Udara</td>
                                        <td>:</td>
                                        <td><span id="pressure2"></span></td>
                                        <td>hPa</td>
                                    </tr>
                                    <tr>
                                        <td>Kelembaban</td>
                                        <td>:</td>
                                        <td><span id="humidity2"></span></td>
                                        <td>%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
                <hr class="hr-3-lg d-none d-lg-block" />
                <hr class="hr-4-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>

    <!-- sentimen modal -->
    <div class="modal fade modal-backdrops" id="sentimenModal" tabindex="-1" aria-labelledby="sentimenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL SENTIMENTAL PENUMPANG</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="listSentimenLatestCommentModal" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <!-- sentimen modal negative-->
    <div class="modal fade modal-backdrops" id="sentimenModalNegative" tabindex="-1" aria-labelledby="sentimenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL SENTIMENTAL NEGATIVE</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="listSentimenLatestCommentModalNegative" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <!-- sentimen modal neutral-->
    <div class="modal fade modal-backdrops" id="sentimenModalNeutral" tabindex="-1" aria-labelledby="sentimenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL SENTIMENTAL NEUTRAL</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="listSentimenLatestCommentModalNeutral" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <!-- sentimen modal positive-->
    <div class="modal fade modal-backdrops" id="sentimenModalPositive" tabindex="-1" aria-labelledby="sentimenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL SENTIMENTAL POSITIVE</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="listSentimenLatestCommentModalPositive" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <!-- sentimen modal -->
    <div class="modal fade modal-backdrops" id="userActive" tabindex="-1" aria-labelledby="userActiveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL USER ACTIVE</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="listSentimenLatestCommentModal" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>

    <!-- kecelakaan modal -->
    <div class="modal fade modal-backdrops" id="kecelakaanModal" tabindex="-1" aria-labelledby="kecelakaanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL RAWAN KECELAKAAN</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <span>Value</span>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
<!-- END DETAIL DATA SIDE A -->

<!-- MODAL SIDE B -->
    <!--jalan Modal -->
    <div class="modal fade modal-backdrops" id="jalanModal" tabindex="-1" aria-labelledby="jalanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL FASILITAS JALAN</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <ul class="list-group list-group-flush" id="fasilitas-jalan-detail-modal" style="width: 100%; height: 100%;"></ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--area berbahaya Modal -->
    <div class="modal fade modal-backdrops" id="terminalModal" tabindex="-1" aria-labelledby="terminalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL TERMINAL</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body overflow-auto custom-scrollbar">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" id="terminal-detail-modal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--area berbahaya Modal -->
    <div class="modal fade modal-backdrops" id="busModal" tabindex="-1" aria-labelledby="busModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL BUS</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <span>Value</span>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->
<!-- END MODAL SIDE B -->

<!-- Modal -->

    <!-- main menu modal -->
    <div class="modal fade modal-backdrops" id="menuModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1 d-none d-lg-block" />
            <hr class="hr-2 d-none d-lg-block" />
            <div class="modal-content position-relative align-items-center" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="head-mod d-flex justify-content-center mb-3 mt-5 pt-5"><h5>Layer</h5></div>
                <div class="modal-body1 w-100 p-4">
                    coming soon
                </div>
                <div class="modal-footer border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3 d-none d-lg-block" />
            <hr class="hr-4 d-none d-lg-block" />
            <div class="side-b d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>

        <!-- <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content align-items-center" style="background: none; border: none;">
        <div class="head-mod text-light d-flex justify-content-center">MAIN MENU</div>

        <div class="modal-body w-50 d-flex flex-wrap justify-content-center">
          Grafik button
          <div class="select-menu-btn d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#grafikModal">
            <i class="fa-solid fa-chart-simple me-3"></i>
            <span class="w-100 text-center">Grafik Statistik</span>
          </div>

          CCTV button
          <div class="select-menu-btn d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#cctvModal">
            <i class="fa-solid fa-camera me-3"></i>
            <span class="w-100 text-center">CCTV</span>
          </div>

          video button
          <div class="select-menu-btn d-flex align-items-center mb-3" data-bs-toggle="modal"
            data-bs-target="#videoModal">
            <i class="fa-solid fa-video me-3"></i>
            <span class="w-100 text-center">Video Conference</span>
          </div>

          info button (hanya mobile mode)
          <div class="select-menu-btn d-flex align-items-center d-lg-none mb-5" data-bs-toggle="modal"
            data-bs-target="#infoModal">
            <i class="fa-solid fa-info ms-1 me-4"></i>
            <span class="w-100 text-center">Informasi</span>
          </div>

          Logout button
          <div id="logout-btn" class="out-btn-b d-flex align-items-center d-lg-none mb-3" onclick="showAlert()">
            <i class="fa-solid fa-right-from-bracket me-3"></i>
            <span class="w-100 text-center">Log Out</span>
          </div>

          cencel button
          <div class="x-btn-b d-flex align-items-center" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark me-3"></i>
            <span class="w-100 text-center">Cancel</span>
          </div>
        </div>
      </div>
    </div> -->
    </div>
    <!-- end main menu -->

    <!-- modal grafik -->
    <div class="modal fade modal-backdrops" id="cctvModal" tabindex="-1" aria-labelledby="cctvModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title " id="cctvModalLabel">CCTV</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <span>Value</span>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- end -->
<!-- Modal -->

<!-- MODAL FOOTER DATA -->
    <!--PNP Modal -->
    <div class="modal fade modal-backdrops" id="pnpModal" tabindex="-1" aria-labelledby="pnpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg h-25">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL JUMLAH PENUMPANG</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="w-100 h-100 row align-items-center">
                            <canvas class="w-100 h-75" id="penumpangChart2"></canvas>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>
    <!-- End Modal -->

    <!--Jumlah Pendapatan Modal -->
    <div class="modal fade modal-backdrops" id="pendapatanModal" tabindex="-1" aria-labelledby="pendapatanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL PENDAPATAN</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body border-0 d-flex align-items-center">
                    <canvas id="incomeChart2" style="width: 100%; height: 100%;"></canvas>
                </div>
                <div class="modal-footer d-grid justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Fasilitas Modal -->
    <div class="modal fade modal-backdrops" id="fasilitasModal" tabindex="-1" aria-labelledby="fasilitasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL AREA BERBAHAYA</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <span>Value</span>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--aduan Modal -->
    <div class="modal fade modal-backdrops" id="aduanModal" tabindex="-1" aria-labelledby="aduanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL ADUAN</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div id="aduan-detail-modal" style="max-height: 42vh;" class="overflow-auto">
                        <i class="fa-solid fa-gear fa-spin"></i> Loading...</i>
                    </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <div class="modal fade modal-backdrops" id="aduanReplyModal" tabindex="-1" aria-labelledby="aduanReplyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <img class="side-a-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
                <hr class="hr-1-lg d-none d-lg-block" />
                <hr class="hr-2-lg d-none d-lg-block" />
                <div>
                    <div class="modal-header border-0">
                        <h1 class="modal-title w-100 text-center " id="Modal-Detail">BALAS ADUAN</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body d-grid overflow-auto custom-scrollbar">
                        <div id="form-detail-aduan" style="max-height: 42vh;" class="overflow-auto">
                        <i class="fa-solid fa-gear fa-spin"></i> Loading...</i>
                    </div>
                    
                    <form id="form-balas-aduan" class="row border-top border-success mt-3 d-flex justify-content-center align-items-center">
                        <!-- <label for="text-aduan-form" class="m-0 text-start">Balas Aduan</label> -->
                        <input type="hidden" name="id-aduan-form" id="id-aduan-form" />
                        <div class="d-flex" style="height: 4rem;">
                            <!-- <textarea class="form-control me-1" name="text-aduan-form" id="text-aduan-form" rows="3" style="background: transparent; border: 2px solid rgb(5, 248, 185); color: #00ffbe;"></textarea> -->
                            <input type="text" class="form-control me-1" name="text-aduan-form" id="text-aduan-form" style="background: transparent; border: 2px solid rgb(5, 248, 185); color: #00ffbe;">
                            <button id="btn-submit-aduan" type="submit" class="btn btn-success" style="background: transparent;border: 2px solid #40e0ad;color: #40e0ad;"><i class="fa-solid fa-reply"></i> Kirim</button>
                        </div>
                    </form>

                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                    </div>
                </div>
                <hr class="hr-4-lg d-none d-lg-block" />
                <hr class="hr-3-lg d-none d-lg-block" />
                <img class="side-b-lg d-none d-lg-block position-absolute" style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>

        </div>
    </div>

    <!-- End Modal -->

    <!--area berbahaya Modal -->
    <div class="modal fade modal-backdrops" id="bencanaModal" tabindex="-1" aria-labelledby="bencanaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="side-a-lg d-none d-lg-block position-absolute">
                <img style="width: 6rem; height: 7.5rem;" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
            <hr class="hr-1-lg d-none d-lg-block" />
            <hr class="hr-2-lg d-none d-lg-block" />
            <div class="modal-content position-relative" style="background: none; border: none; color: aquamarine; animation: back-animation 2s infinite;">
                <div class="modal-header border-0" style="margin-top: 8rem;">
                    <h1 class="modal-title w-100 text-center " id="Modal-Detail">DETAIL AREA BERBAHAYA</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <span>Value</span>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik bebas untuk keluar</span>
                </div>
            </div>
            <hr class="hr-3-lg d-none d-lg-block" />
            <hr class="hr-4-lg d-none d-lg-block" />
            <div class="side-b-lg d-none d-lg-block position-absolute w-100">
                <img style="width: 6rem; height: 7.5rem; transform: scaleX(-1) scaleY(-1);" src="<?= base_url() ?>assets/hud/img/dashboard/side-border.png" alt="" />
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- chat whatsapp modal -->

    <!-- chat modal user all -->    
    <div class="modal fade modal-backdrops" id="chatUserAllModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chatUserAllModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background: #252525; opacity: 80%; border: 1px solid aquamarine; color: aquamarine;">
                <div class="modal-header">
                    <h1 class="modal-title " id="chatUserAllModalLabel" style="color: aquamarine;"> <i class="fa-brands fa-whatsapp"></i> Whatsapp - Daftar Pesan </h1>
                    <a href="javascript:void(0)" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close">
                        <i style="color: aquamarine;" class="fa-solid fa-close"></i>
                    </a>
                </div>

                <div class="modal-body" style="height: 50vh; border: 1px solid aquamarine;">
                    
                    <div class="list-group">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex w-100 align-items-center"> 
                                    @if(auth()->user()->photo != null) 
                                        <img src="{{ auth()->user()->photo }}" alt="user1" width="54" height="54" class="rounded-circle"> 
                                    @else
                                        <img src="{{ asset('assets/images/default_profile.png') }}" alt="user1" width="54" height="54" class="rounded-circle"> 
                                    @endif 
                                    <div>
                                        <h5 class="mb-1 ps-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                                        <p class="mb-0 ps-2">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <hr>

                    <div class="input-group flex-nowrap pt-3 pb-3 d-none">
                        <span class="input-group-text" id="addon-wrapping" style="background: transparent;color: aquamarine;border: 1px solid;">
                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        </span>
                        <input type="search" class="form-control" placeholder="Pencarian.." aria-label="find-chat" aria-describedby="addon-wrapping" style="background: transparent;color: aquamarine;border: 1px solid;">
                    </div>

                    <div class="list-group" id="listWhatsappChat">
                        
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex w-100 align-items-center">
                                        <img src="{{ asset('assets/images/default_profile.png') }}" alt="Profile Picture" alt="user1" width="54" height="54" class="rounded-circle">
                                        <div>
                                            <h5 class="mb-1 ps-2">Loading..</h5>
                                            <p class="mb-1 ps-2">...</p>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <i style="color: green;" class="fa-solid fa-circle"></i>
                                    </small>
                                </div>
                            </a>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik disini untuk keluar</span>
                </div>
            </div>
        </div>
    </div>


    <!-- chat modal per user -->  
    <div class="modal fade modal-backdrops" id="chatWaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chatWaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content" style="background: #252525; opacity: 95%; border: 1px solid aquamarine; color: aquamarine;">
                <div class="modal-header">
                    <div class="">
                        <!-- p-9 mb-5 pb-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between -->
                        <div class="hstack gap-3 current-chat-user-name">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/default_profile.png') }}" width="48" height="48" class="rounded-circle">
                            </div>
                            <div>
                                <h6 class="mb-1 name fw-semibold"></h6>
                                <p class="mb-0" style="font-weight: bold" id="nameUserChat">-</p>
                                <p class="mb-0" id="phoneUserChat">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body" style="height: 90vh; border: 1px solid aquamarine;">
                    
                    
                    
                    <div id="list-whatsapp-modal" style="max-height: 73vh;" class="overflow-auto">
                        <div class="w-70 w-xs-100 chat-container" id="canvas-chats" style="display: none">
                            <div class="chat-box-inner-part h-100">
                                <div class="chatting-box d-block">
                                    <div class="parent-chat-box">
                                        <div class="chat-box w-xs-100">
                                            <div class="chat-box-inner p-9" data-simplebar="init">
                                                <div class="simplebar-wrapper" style="margin: -20px;">
                                                    <div class="simplebar-height-auto-observer-wrapper">
                                                        <div class="simplebar-height-auto-observer"></div>
                                                    </div>
                                                    <div class="simplebar-mask">
                                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                                                                <div class="simplebar-content" style="padding: 20px; overflow-y:scroll; max-height: 100%;">
                                                                    <div class="chat-list chat active-chat" id="canvas-active-chat-conversation">
                                                                        {{-- list chat conversation --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="simplebar-placeholder" style="width: 100%; height: 400px;"></div> -->
                                                </div>
                                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                                </div>
                                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 pt-2 border-top border-success">
                        <div class="col-md-11">
                            <label for="typeMessage" class="form-label">Ketik Balasan Whatsapp</label>
                            <input type="text" class="form-control" name="typeMessage" id="typeMessage" placeholder="Type a message..." fdprocessedid="0p3op" style="background: transparent; border: 2px solid rgb(5, 248, 185); color: #00ffbe;" />
                        </div>
                        <div class="col-md-1">
                            <div style="margin-top: 32px;">
                                <button id="btn-submit-wa" onclick="sendMessage()" type="button" class="btn btn-success" style="background: transparent;border: 2px solid #40e0ad;color: #40e0ad;">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik disini untuk keluar</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end chat whatsapp modal -->

    <!-- modal chart traffic -->
    <div class="modal fade modal-backdrops" id="chartTrafficModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chartTrafficModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background: #252525; opacity: 80%; border: 1px solid aquamarine; color: aquamarine;">
                <div class="modal-header">
                    <h1 class="modal-title " id="chartTrafficModalLabel" style="color: aquamarine;"> <i class="fa-solid fa-traffic-light"></i> Chart - Traffic </h1>
                    <a href="javascript:void(0)" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close">
                        <i style="color: aquamarine;" class="fa-solid fa-close"></i>
                    </a>
                </div>

                <div class="modal-body" style="height: 50vh; border: 1px solid aquamarine;">
                    
                    <div style="max-width: 100%;height: 50vh;" class="p-5">
                        <canvas id="trafficChart"></canvas>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <span data-bs-dismiss="modal" style="cursor: pointer;">klik disini untuk keluar</span>
                </div>
            </div>
        </div>
    </div>
    <!-- modal chart traffic -->
<!-- END MODAL FOOTER DATA -->