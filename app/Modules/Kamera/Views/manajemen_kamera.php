<div class="row d-none">
	<div class="col-sm-6 col-xl-4">
		<div class="card bg-primary-subtle" style="background-color: #f2f5d8 !important">
		  <div class="card-body p-4">
			<div class="d-flex align-items-center">
			  <h5 class="mb-0">Total</h5>
			</div>
			<div class="d-flex align-items-center justify-content-between mt-4">
			  <h3 class="mb-0 fw-semibold fs-7">Total</h3>
			  <span class="fw-bold" style="font-size: 22px;" id="widgetTotal">0</span>
			</div>
		  </div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-4">
		<div class="card bg-primary-subtle" style="background-color: #a3e1a3 !important">
		  <div class="card-body p-4">
			<div class="d-flex align-items-center">
			  <h5 class="mb-0">Terkoneksi</h5>
			</div>
			<div class="d-flex align-items-center justify-content-between mt-4">
			  <h3 class="mb-0 fw-semibold fs-7">Total</h3>
			  <span class="fw-bold" style="font-size: 22px;" id="widgetTotalConnect">0</span>
			</div>
		  </div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-4">
		<div class="card bg-primary-subtle" style="background-color: #f5d8d8 !important">
		  <div class="card-body p-4">
			<div class="d-flex align-items-center">
			  <h5 class="mb-0">Tidak Terkoneksi</h5>
			</div>
			<div class="d-flex align-items-center justify-content-between mt-4">
			  <h3 class="mb-0 fw-semibold fs-7">Total</h3>
			  <span class="fw-bold" style="font-size: 22px;" id="widgetTotalNotConnect">0</span>
			</div>
		  </div>
		</div>
	</div>
</div>

<div class="row">
    <div class="card shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
            <ul id="tab" class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-data" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="fas fa-table"></i></span>
                        <span class="d-none d-sm-block">Data</span>
                    </a>
                </li>
                <?php if ($rules->i == "1") { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-form" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fab fa-wpforms"></i></span>
                            <span class="d-none d-sm-block">Update</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="tab-data" role="tabpanel">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-theme table-row v-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CCTV</th>
                                    <th>Provinsi</th>
                                    <th>Kota/Kab.</th>
                                    <th>Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th class="column-2action"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($rules->i == "1") { ?>
                    <div class="tab-pane" id="tab-form" role="tabpanel">
                        <div class="card-body">
                            <form data-plugin="parsley" data-option="{}" id="form" validate>
                                <input type="hidden" class="form-control" id="id" name="id" required>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Nama CCTV</label>
                                            <input type="text" class="form-control" id="cctv_name" name="cctv_name" autocomplete="off" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>URL Streaming</label>
                                            <input type="text" class="form-control" id="url_streaming" name="url_streaming" autocomplete="off" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Provinsi</label>
                                        <select class="form-control sel2" id="id_provinsi" name="id_provinsi" required></select>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Kab / Kota</label>
                                        <select class="form-control sel2" id="id_kota_kab" name="id_kota_kab" required></select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" autocomplete="off" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" autocomplete="off" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude" autocomplete="off" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <button class="btn btn-dark" type="reset">Reset</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const auth_insert = '<?= $rules->i ?>';
    const auth_edit = '<?= $rules->e ?>';
    const auth_delete = '<?= $rules->d ?>';
    const auth_otorisasi = '<?= $rules->o ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEvents;

    const select2Array = [{
            id: 'id_provinsi',
            url: '/id_provinsi_select_get',
            placeholder: 'Pilih Provinsi',
            params: null
        },
        {
            id: 'id_kota_kab',
            url: '/id_kota_kab_select_get',
            placeholder: 'Pilih Kota/Kabupaten',
            params: {
                id_provinsi: function() {
                    return $('#id_provinsi').val()
                }
            }
        }
    ];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder: 'Berhasil menyimpan data Kamera',
            afterAction: function(result) {
                $(".sel2").val(null).trigger('change');
            }
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                setTimeout(function() {
                    select2Array.forEach(function(x) {
                        $('#' + x.id).select2('trigger', 'select', {
                            data: {
                                id: result.data[x.id],
                                text: result.data[x.id.replace('id', 'nama')]
                            }
                        });
                    });
                }, 100);
            }
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus data Kamera',
            afterAction: function() {}
        }

        coreEvents.resetHandler = {
            action: function() {}
        }

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        coreEvents.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari Kamera';

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons, coreEvents.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });


    // Fetch total camera data
    async function fetchCameraData() {
        const endpoints = [
            { url: `${url_ajax}/total_camera`, elementId: 'widgetTotal', key: 'total' },
            { url: `${url_ajax}/total_camera_terkoneksi`, elementId: 'widgetTotalConnect', key: 'total_connect' },
            { url: `${url_ajax}/total_camera_tidak_terkoneksi`, elementId: 'widgetTotalNotConnect', key: 'total_not_connect' }
        ];

        await endpoints.forEach(endpoint => {
            fetch(endpoint.url)
                .then(response => response.json())
                .then(response => {
                    document.getElementById(endpoint.elementId).innerText = response.data[endpoint.key];
                })
                .catch(error => console.error(`Error fetching data from ${endpoint.url}:`, error));
        });
    }

    $(document).ajaxComplete(function() {
        // fetchCameraData();
    });
    
    function datatableColumn() {
        let columns = [{
                data: "id",
                title: "#",
                orderable: false,
                width: 5,
                className: 'text-center align-middle fw-bold',
                render: function(a, type, data, index) {
                    return `<span>${dataStart + index.row + 1}.</span>`;
                }
            },
            {
                data: "cctv_name",
                title: "CCTV",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "provinsi_name",
                title: "Provinsi",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "kota_kabupaten_name",
                title: "Kota/Kab.",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "lokasi",
                title: 'lokasi',
                orderable: true,
                width: 100,
                className: 'text-center align-middle',
            },
			{
				data: "latitude",
				title: "Latitude",
				orderable: true,
				width: 100,
				className: 'text-start align-middle',
			},
			{
				data: "longitude",
				title: "Longitude",
				orderable: true,
				width: 100,
				className: 'text-start align-middle',
			},
            {
                data: "id",
                title: null,
                orderable: false,
                width: 1,
                className: 'text-center align-middle',
                render: function(a, type, data, index) {
                    let button = ''
                    button += `<a href="${data.url_streaming}" class="btn btn-sm btn-outline-success" data-id="${data.id}" target="_blank" title="Streaming Kamera"><i class="fa fa-camera"></i></a>`;
                    if (auth_edit == "1") {
                        button += `<button class="btn btn-sm btn-outline-primary edit" data-id="${data.id}" title="Edit"><i class="fa fa-edit"></i></button>`;
                    }
                    if (auth_delete == "1") {
                        button += `<button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}" title="Delete"><i class="bx bx-trash-alt"></i></button>`;
                    }
                    button += (button == '') ? "<i class='fa fa-ban'></i>" : "";
                    return `<div class='btn-group'>${button}</div>`;
                }
            }
        ];

        return columns;
    }
</script>