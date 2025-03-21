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
                                    <th>IMEI GPS</th>
                                    <th>No. Kendaraan</th>
                                    <th>Rute</th>
                                    <th>Alamat</th>
                                    <th>Last Update</th>
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>IMEI GPS</label>
                                            <input type="text" class="form-control" id="gps_sn" name="gps_sn" autocomplete="off" placeholder="0359857083192112" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Rute Type</label>
                                            <input type="text" class="form-control" id="route_type" name="route_type" autocomplete="off" placeholder="AKAP" value="AKAP" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>No. Kendaraan</label>
                                            <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" autocomplete="off" placeholder="E 7536 KC" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Nama Pengirim</label>
                                            <input type="text" class="form-control" id="name_sender" name="name_sender" autocomplete="off" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Nama Klien</label>
                                            <input type="text" class="form-control" id="name_client" name="name_client" autocomplete="off" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Region</label>
                                            <input type="text" class="form-control" id="region" name="region" autocomplete="off" placeholder="-" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Rute</label>
                                            <input type="text" class="form-control" id="route" name="route" autocomplete="off" placeholder="-" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" autocomplete="off" placeholder="-6.16958" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude" autocomplete="off" placeholder="106.80381" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address" autocomplete="off" placeholder="JALAN KYAI HAJI HASYIM ASHARI, CIDENG, GAMBIR, KOTA JAKARTA PUSAT, DKI JAKARTA, INDONESIA" />
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

    const select2Array = [];

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
            afterAction: function(result) {}
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {}
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
                data: "gps_sn",
                title: "IMEI GPS",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "nomor_kendaraan",
                title: "No. Kendaraan",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "route_type",
                title: "Rute",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "signal",
                title: 'Status',
                orderable: false,
                width: 100,
                className: 'text-center align-middle',
                render: function(a, type, data, index) {
                    let address = data.address;
                    let isAddress = `Posisi terakhir: ${address}`;
                    let signal = `Tidak Terkoneksi`;
                    let isClass = 'danger';
                    if (data.signal == "1") {
                        isClass = 'success';
                        signal = `Terkoneksi`;
                    }
                    let button = `<button class="btn btn-sm btn-outline-${isClass}" title="${isAddress}">${signal}</button>`;
                    return `${button}`;
                }
            },
			{
				data: "date_tracker",
				title: "Last Update",
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
                    button += `<a href="<?= base_url('vehicles/lacak'); ?>?plate=${data.nomor_kendaraan}" class="btn btn-sm btn-outline-info show-on-map" data-id="${data.id}" target="_blank" title="Lihat di peta"><i class="bx bx-car"></i></a>`;
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