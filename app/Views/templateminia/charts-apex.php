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
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line with Data Labels</h4>
                            </div>
                            <div class="card-body">

                                <div id="line_chart_datalabel" data-colors='["#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Dashed Line</h4>
                            </div>
                            <div class="card-body">

                                <div id="line_chart_dashed" data-colors='["#5156be", "#fd625e", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Spline Area</h4>
                            </div>
                            <div class="card-body">
                                <div id="spline_area" data-colors='["#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Column Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="column_chart" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Column with Data Labels</h4>
                            </div>
                            <div class="card-body">
                                <div id="column_chart_datalabel" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bar Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="bar_chart" data-colors='["#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line, Column & Area Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="mixed_chart" data-colors='["#fd625e", "#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Radial Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="radial_chart" data-colors='["#5156be", "#2ab57d", "#fd625e", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!--end card-->

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Pie Chart</h4>
                            </div>
                            <div class="card-body">

                                <div id="pie_chart" data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Donut Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="donut_chart" data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
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

<!-- apexcharts js -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="assets/js/pages/apexcharts.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>