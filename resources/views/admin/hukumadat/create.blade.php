@extends('admin.admin_layouts')
@section('admin_content')

<style>
    fieldset {
        border: 2px solid #007bff;
        border-radius: 5px;
    }

    legend {
        font-size: 15px;
        font-weight: bold;
        color: #007bff;
    }
</style>

<h1 class="h3 mb-3 text-gray-800">Tambah Hukum Adat</h1>

<form action="{{ route('admin.hukumadat.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Hukum Adat</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.hukumadat.index') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i> Lihat List
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama Hukum Adat</label>
                        <input type="text" name="hukumadat_name" class="form-control form-control-sm" value="{{ old('hukumadat_name') }}" autofocus required>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Foto</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMaterials" id="addBtnDynamicMaterial" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddMaterials" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Foto</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div>

            <!-- materi_regulasi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Regulasi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMaterials" id="addBtnDynamicRegulasi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddRegulasis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Regulasi </th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div>
            <!-- materi_refrensi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Refrensi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMaterials" id="addBtnDynamicRefrensi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddRefrensis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Refrensi </th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div>
            <!-- materi_dokumentasi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Dokumentasi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMaterials" id="addBtnDynamicDokumentasi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddDokumentasis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Dokumentasi </th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div>
            <!-- materi_link -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Link</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMaterials" id="addBtnDynamicLink" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddLinks" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Link </th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </fieldset>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-block btn-sm btn-success">
                Simpan
            </button>
        </div>
    </div>
</form>

<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">
                    <i class="fas fa-info-circle" style="color: #F7E5A1;"></i>
                    Informasi
                </h4>
            </div>
            <div class="modal-body" style="font-size: small;">
                Maksimal 10 row yang bisa ditambahkan
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-ok" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var f = 0;
    $("#addBtnDynamicMaterial").click(function() {
        if (f <= 9) {
            var newRowFoto = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_foto[]" accept=".jpg, .jpeg, .png" value=""></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddMaterials").append(newRowFoto);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++f;
    });

    $(document).on('click', '.remove-input-documents', function() {
        --f;
        $(this).parents('tr').remove();
    });

    /* materi_regulasi */
    var r = 0;
    $("#addBtnDynamicRegulasi").click(function() {
        if (r <= 9) {
            var newRowRegulasi = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_regulasi[]" accept=".pdf" value=""></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-regulasi"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddRegulasis").append(newRowRegulasi);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++r;
    });

    $(document).on('click', '.remove-input-regulasi', function() {
        --r;
        $(this).parents('tr').remove();
    });

    /* materi_refrensi */
    var ref = 0;
    $("#addBtnDynamicRefrensi").click(function() {
        if (ref <= 9) {
            var newRowRefrensi = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_refrensi[]" accept=".pdf" value=""></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-refrensi"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddRefrensis").append(newRowRefrensi);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++ref;
    });

    $(document).on('click', '.remove-input-refrensi', function() {
        --ref;
        $(this).parents('tr').remove();
    });

    /* materi_dokumentasi */
    var d = 0;
    $("#addBtnDynamicDokumentasi").click(function() {
        if (d <= 9) {
            var newRowDokumentasi = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_dokumentasi[]" accept=".pdf" value=""></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-dokumentasi"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddDokumentasis").append(newRowDokumentasi);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++d;
    });

    $(document).on('click', '.remove-input-dokumentasi', function() {
        --d;
        $(this).parents('tr').remove();
    });

    /* materi_link */
    var l = 0;
    $("#addBtnDynamicLink").click(function() {
        if (l <= 9) {
            var newRowLink = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="text" name="materi_link[]" class="form-control form-control-sm" value=""></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-link"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddLinks").append(newRowLink);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++l;
    });

    $(document).on('click', '.remove-input-link', function() {
        --l;
        $(this).parents('tr').remove();
    });



    $("#bimtek_start_date").datepicker({
        minDate: new Date(),
        defaultDate: new Date(),
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        onSelect: function(selectedDate) {
            $("#bimtek_end_date").datepicker("option", "minDate", selectedDate);
        }
    });

    $("#bimtek_end_date").datepicker({
        minDate: new Date(),
        defaultDate: new Date(),
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        onSelect: function(selectedDate) {
            $("#bimtek_start_date").datepicker("option", "maxDate", selectedDate);
        }
    });
</script>

@endsection
