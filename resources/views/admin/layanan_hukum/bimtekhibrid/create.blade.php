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

    <h1 class="h3 mb-3 text-gray-800">Tambah Bimtek Hybrid</h1>

    <form action="{{ route('admin.layanan_hukum.bimtekhibrid.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Bimtek Hybrid</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.layanan_hukum.bimtekhibrid.index') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> Lihat List
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Judul Bimtek *</label>
                            <input type="text" name="bimtek_name" class="form-control form-control-sm" value="{{ old('bimtek_name') }}" autofocus required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Link Zoom *</label>
                            <input type="text" name="bimtek_link_zoom" class="form-control form-control-sm" value="{{ old('bimtek_link_zoom') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Link Pendaftaran *</label>
                            <input type="text" name="bimtek_link_register" class="form-control form-control-sm" value="{{ old('bimtek_link_register') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tgl Mulai Bimtek *</label>
                            <input id="bimtek_start_date" type="text" name="bimtek_start_date" class="form-control form-control-sm" value="{{ old('bimtek_start_date') }}" style="background-color: white;" readonly required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tgl Berakhir Bimtek *</label>
                            <input id="bimtek_end_date" type="text" name="bimtek_end_date" class="form-control form-control-sm" value="{{ old('bimtek_end_date') }}" style="background-color: white;" readonly required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Deskripsi Bimtek</label>
                            <textarea name="bimtek_desc" class="form-control form-control-sm" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Link Dokumentasi</label>
                            <input type="text" name="bimtek_link_doc" class="form-control form-control-sm" value="{{ old('bimtek_link_doc') }}">
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <fieldset class="border p-2 mb-4">
                        <legend class="w-auto">Materi Bimtek</legend>
                        <div style="margin-bottom: 5px;">
                            <button type="button" name="addMaterials" id="addBtnDynamicMaterial" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i>&nbsp;Tambah
                            </button>
                        </div>

                        <div>
                            <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicAddMaterials" width="100%" cellspacing="0" style="font-size: small;">
                                <tr>
                                    <th style="text-align: center;">Materi</th>
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
    var x = 0;
    $("#addBtnDynamicMaterial").click(function () {
        if(x <= 9) {
            var newRow = $('<tr>' +
                            '<td style="text-align: left; vertical-align: middle;"><input type="file" name="materi_file[]" accept=".pdf, .ppt, .pptx" value=""></td>' +
                            '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td>' +
                            '</tr>'
            );

            $("#dynamicAddMaterials").append(newRow);
        } else {
            $("#alert-modal").modal('show');
            return false;
        }
        ++x;
    });

    $(document).on('click', '.remove-input-documents', function () {
        --x;
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