@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Indeks IKD</h1>

    <form action="{{ route('admin.index_hukum.ikd.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Indeks IKD</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.index_hukum.ikd.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addDocuments" id="addBtnDynamic" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-fixed table-condensed table-bordered table-striped" id="dynamicIkd" width="100%" cellspacing="0" style="font-size: small;">
                        <tr>
                            <th style="text-align: center;">Judul</th>
                            <th style="text-align: center;">Tahun</th>
                            <th style="text-align: center;">Nilai</th>
                            <th style="text-align: center;">File (Ekstensi File: .pdf || Maks.: 4MB)</th>
                            <th style="width: 5%; text-align: center;">Aksi</th>
                        </tr>
                    </table>
                </div>
                
                <div class="row">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
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
                    Maksimal 5 row yang bisa ditambahkan
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
        $("#addBtnDynamic").click(function () {
            if(x <= 4) {
                var newRow = $('<tr>' +
                                '<td style="width: 40%; text-align: center; vertical-align: middle;"><input type="text" name="ikd_name[]" class="form-control form-control-sm" value=""></td>' +
                                '<td style="width: 10%; text-align: center; vertical-align: middle;"><input type="text" name="ikd_year[]" maxlength="4" class="form-control form-control-sm" value=""></td>' +
                                '<td style="width: 10%; text-align: center; vertical-align: middle;"><input type="text" name="ikd_score[]" class="form-control form-control-sm" value=""></td>' +
                                '<td style="width: 30%; text-align: left; vertical-align: middle;"><input type="file" name="ikd_file[]" accept=".pdf" value=""><hr>' +
                                '<div class="row"><div class="col-md-6"><div class="form-check"><input class="form-check-input" type="radio" name="ikd_file_view['+ x +']" id="ikd_file_view_show_'+ x +'" value="0"><label class="form-check-label" for="ikd_file_view_show_'+ x +'">Tampil di web</label></div></div>' +
                                '<div class="col-md-6"><div class="form-check"><input class="form-check-input" type="radio" name="ikd_file_view['+ x +']" id="ikd_file_view_hide_'+ x +'" value="1"><label class="form-check-label" for="ikd_file_view_hide_'+ x +'">Tidak tampil di web</label></div></div></div></td>' +
                                '<td style="width: 5%; text-align: center; vertical-align: middle;"><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td>' +
                                '</tr>'
                );
        
                newRow.find('input[name="ikd_year[]"], input[name="ikd_score[]"]').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, "").replace(/(\..*)\./g, "$1");
                });
                
                $("#dynamicIkd").append(newRow);
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
    </script>

@endsection
