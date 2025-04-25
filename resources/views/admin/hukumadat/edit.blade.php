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

<h1 class="h3 mb-3 text-gray-800">Ubah Hukum Adat</h1>

<form action="{{ url('admin/hukum-adat/update/'.$hukumadat->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Hukum Adat</h6>
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
                        <label for="">Nama Hukum Adat *</label>
                        <input type="text" name="hukumadat_name" class="form-control form-control-sm" value="{{ $hukumadat->hukumadat_name }}" autofocus required>
                    </div>
                </div>
            </div>

            <!-- materi_foto -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Foto</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addFotos" id="addBtnDynamicFoto" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddFotos" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Foto</th>
                                <th style="width: 5%; text-align: center;">Hapus</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                            @if(count($hukumadat->hukumadatregulasi->where('materi_type', 1)) != 0)
                            @foreach($hukumadat->hukumadatregulasi->where('materi_type', 1) as $material)
                            @if($material->is_deleted == 0)
                            <tr>
                                <td style="text-align: left; vertical-align: middle;">
                                    <input type="file" name="materi_file[]" accept=".jpg, .png, .jpeg">
                                    <img src="{{ asset('storage/places/materi_hukumadat/'.$material->materi_file) }}" alt="" class="w_300">


                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="delete_materi[]" value="{{ $material->id }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </fieldset>
            </div>

            <!-- materi_regulasi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Regulasi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addRegulasis" id="addBtnDynamicRegulasi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddRegulasis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Regulasi</th>
                                <th style="width: 5%; text-align: center;">Hapus</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                            @if(count($hukumadat->hukumadatregulasi->where('materi_type', 2)) != 0)
                            @foreach($hukumadat->hukumadatregulasi->where('materi_type', 2) as $material)
                            @if($material->is_deleted == 0)
                            <tr>
                                <td style="text-align: left; vertical-align: middle;">
                                    <input type="file" name="materi_regulasi[]" accept=".pdf">
                                    <small>{{ $material->materi_file }}</small>
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="delete_materi[]" value="{{ $material->id }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </fieldset>
            </div>

            <!-- materi_refrensi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Refrensi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addRefrensis" id="addBtnDynamicRefrensi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddRefrensis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Refrensi</th>
                                <th style="width: 5%; text-align: center;">Hapus</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                            @if(count($hukumadat->hukumadatregulasi->where('materi_type', 3)) != 0)
                            @foreach($hukumadat->hukumadatregulasi->where('materi_type', 3) as $material)
                            @if($material->is_deleted == 0)
                            <tr>
                                <td style="text-align: left; vertical-align: middle;">
                                    <input type="file" name="materi_refrensi[]" accept=".pdf">
                                    <small>{{ $material->materi_file }}</small>
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="delete_materi[]" value="{{ $material->id }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </fieldset>
            </div>

            <!-- materi_dokumentasi -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Dokumentasi</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addDokumentasis" id="addBtnDynamicDokumentasi" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddDokumentasis" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Dokumentasi</th>
                                <th style="width: 5%; text-align: center;">Hapus</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                            @if(count($hukumadat->hukumadatregulasi->where('materi_type', 4)) != 0)
                            @foreach($hukumadat->hukumadatregulasi->where('materi_type', 4) as $material)
                            @if($material->is_deleted == 0)
                            <tr>
                                <td style="text-align: left; vertical-align: middle;">
                                    <input type="file" name="materi_dokumentasi[]" accept=".pdf">
                                    <small>{{ $material->materi_file }}</small>
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="delete_materi[]" value="{{ $material->id }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </fieldset>
            </div>


            <!-- materi_link -->
            <div class="card-body">
                <fieldset class="border p-2 mb-4">
                    <legend class="w-auto">Link</legend>
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addLinks" id="addBtnDynamicLink" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddLinks" width="100%" cellspacing="0" style="font-size: small;">
                            <tr>
                                <th style="text-align: center;">Link</th>
                                <th style="width: 5%; text-align: center;">Hapus</th>
                                <th style="width: 5%; text-align: center;">Aksi</th>
                            </tr>
                            @if(count($hukumadat->hukumadatregulasi->where('materi_type', 5)) != 0)
                            @foreach($hukumadat->hukumadatregulasi->where('materi_type', 5) as $material)
                            @if($material->is_deleted == 0)
                            <tr>
                                <td style="text-align: left; vertical-align: middle;">
                                    <input type="text" class="form-control form-control-sm" readonly value="{{ $material->materi_file }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="delete_materi[]" value="{{ $material->id }}">
                                </td>
                                <td style="width: 5%; text-align: center; vertical-align: middle;"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </fieldset>
            </div>



            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-sm btn-success">
                    Ubah
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
    /* materi_foto */
    var f = $("#dynamicAddFotos tr").length - 1;

    $("#addBtnDynamicFoto").click(function() {
        if (f < 10) {
            var newRow = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_foto[]" accept=".jpg, .png, .jpeg"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-fotos"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddFotos").append(newRow);
            f++;
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
    });

    $(document).on('click', '.remove-input-fotos', function() {
        $(this).parents('tr').remove();
        f--;
    });

    /* materi_regulasi */
    var r = $("#dynamicAddRegulasis tr").length - 1;

    $("#addBtnDynamicRegulasi").click(function() {
        if (r < 10) {
            var newRow = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_regulasi[]" accept=".pdf"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-regulasis"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddRegulasis").append(newRow);
            r++;
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
    });

    $(document).on('click', '.remove-input-regulasis', function() {
        $(this).parents('tr').remove();
        r--;
    });

    /* materi_refrensi */
    var ref = $("#dynamicAddRegulasis tr").length - 1;

    $("#addBtnDynamicRefrensi").click(function() {
        if (ref < 10) {
            var newRow = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_refrensi[]" accept=".pdf"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-refrensis"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddRefrensis").append(newRow);
            ref++;
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
    });

    $(document).on('click', '.remove-input-refrensis', function() {
        $(this).parents('tr').remove();
        ref--;
    });

    /* materi_dokumentasi */
    var d = $("#dynamicAddDokumentasis tr").length - 1;

    $("#addBtnDynamicDokumentasi").click(function() {
        if (d < 10) {
            var newRow = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_dokumentasi[]" accept=".pdf"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-dokumentasis"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddDokumentasis").append(newRow);
            d++;
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
    });

    $(document).on('click', '.remove-input-dokumentasis', function() {
        $(this).parents('tr').remove();
        d--;
    });

    /* materi_link */
    var l = $("#dynamicAddLinks tr").length - 1;

    $("#addBtnDynamicLink").click(function() {
        if (l < 10) {
            var newRow = $('<tr>' +
                '<td style="text-align: left; vertical-align: middle;"><input type="text" name="materi_link[]" class="form-control form-control-sm"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"></td>' +
                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-links"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );

            $("#dynamicAddLinks").append(newRow);
            l++;
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
    });

    $(document).on('click', '.remove-input-links', function() {
        $(this).parents('tr').remove();
        l--;
    });
</script>

@endsection