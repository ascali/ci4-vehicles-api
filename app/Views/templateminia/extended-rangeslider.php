<?= $this->include('partials/head-main') ?>

<head>

    <?= $title_meta ?>
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">noUiSlider</h5>
                                <p class="card-title-desc">noUiSlider is lightweight Javascript range slider</p>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="mb-5">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Basic Example</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="slider"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Colorpicker</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="sliders" id="red"></div>
                                                <div class="sliders" id="green"></div>
                                                <div class="sliders" id="blue"></div>

                                                <div id="result"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Using HTML5 input elements</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="html5"></div>
                                                <div class="d-flex flex-wrap">
                                                    <select id="input-select" class="form-select"></select>
                                                    <input type="number" class="form-control" min="-20" max="40" step="1" id="input-number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Non linear slider</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="nonlinear"></div>
                                                <span class="example-val" id="lower-value"></span>
                                                <span class="example-val" id="upper-value"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Locking sliders together</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="slider" id="slider1"></div>
                                                <span class="example-val mt-2" id="slider1-span"></span>

                                                <div class="slider" id="slider2"></div>
                                                <span class="example-val mt-2" id="slider2-span"></span>

                                                <button id="lockbutton" class="btn btn-primary" style="float: right; margin: 20px 0 0;">Lock</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Only showing tooltips when sliding handle</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="slider" id="slider-hide"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Colored Connect Elements</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="slider" id="slider-color"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Creating a toggle</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="slider-toggle"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">Soft limits</h5>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="soft"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- nouisliderribute js -->
<script src="assets/libs/nouislider/nouislider.min.js"></script>
<script src="assets/libs/wnumb/wNumb.min.js"></script>

<!-- range slider init -->
<script src="assets/js/pages/rangeslider.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>