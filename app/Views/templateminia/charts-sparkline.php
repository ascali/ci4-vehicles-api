<?= $this->include('partials/head-main') ?>

<head>

    <?= $title_meta ?>

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
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Pie Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline1" data-colors='["#2ab57d", "#5156be", "#e9ecef"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bar Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline2" data-colors='["#2ab57d"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line Chart</h4>
                            </div>
                            <div class="card-body analytics-info">
                                <div id="sparkline4" data-colors='["#5156be"]'></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Composite Bar Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline3" data-colors='["#5156be", "#2ab57d"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline5" data-colors='["#5156be", "rgba(81, 86, 190, 0.3)", "#2ab57d", "rgba(42, 181, 125, 0.3)"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-header bg-transparent">
                                <h4 class="card-title text-white mb-0">Discrete Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline6" data-colors='["#fff"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bullet Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline7" data-colors='["#5156be", "#fd625e"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Box Plot Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline8" data-colors='["#2ab57d"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Tristate Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="sparkline9" data-colors='["#5156be", "#2ab57d", "#f46a6a"]' class="text-center"></div>
                            </div>
                        </div>
                    </div>
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
<!-- jquery-sparkline js -->
<script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- sparkline init -->
<script src="assets/js/pages/sparklines.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>