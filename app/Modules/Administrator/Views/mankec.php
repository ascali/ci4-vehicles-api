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
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="tab-data" role="tabpanel">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-theme table-row v-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Provinsi</th>
                                    <th>Kab / Kota</th>
                                    <th>Kecamatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <?php if ($rules->i == "1") { ?>
                    <div class="tab-pane" id="tab-form" role="tabpanel">
                        <div class="card-body">
                            <form data-plugin="parsley" data-option="{}" id="form" validate>
                                <input type="hidden" class="form-control" id="id" name="id" value="" required>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Provinsi</label>
                                        <select class="form-control sel2" id="idprov" required>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Kab / Kota</label>
                                        <select class="form-control sel2" id="idkabkota" name="idkabkota" required></select>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" id="kec" name="kec" maxlength="100" required autocomplete="off" placeholder="Tentukan nama kecamatan">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button class="btn btn-dark" type="reset">Reset</button>
                            </form>
                        </div>
                    </div <?php } ?>>
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
            id: 'idprov',
            url: '/idprov_select_get',
            placeholder: 'Pilih Provinsi',
            params: null
        },
        {
            id: 'idkabkota',
            url: '/idkabkota_select_get',
            placeholder: 'Pilih Kab / Kota',
            params: {
                idprov: function() {
                    return $('#idprov').val()
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
            placeholder: 'Berhasil menyimpan data kecamatan',
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
            placeholder: 'Berhasil menghapus data kecamatan',
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
        coreEvents.placeholder = 'Cari Kecamatan';

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons, coreEvents.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
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
                data: "namaprov",
                title: "Provinsi",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "kabkota",
                title: "Kab / Kota",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "kec",
                title: "Kecamatan",
                orderable: true,
                width: 100,
                className: 'text-start align-middle',
            },
            {
                data: "id",
                title: null,
                orderable: false,
                width: 5,
                className: 'text-center align-middle',
                render: function(a, type, data, index) {
                    let button = ''
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