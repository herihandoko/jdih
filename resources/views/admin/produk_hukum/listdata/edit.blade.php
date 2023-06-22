@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Produk Hukum</h1>

    <form action="{{ url('admin/produk-hukum/list-data/update/'.$produkHukumList->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Kategori {{ $produkHukumCategoryName->category_name }}</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.produk_hukum.listdata.index') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> Lihat List
                    </a>
                </div>
            </div>
            
            @if(Illuminate\Support\Str::contains($produkHukumCategoryName->category_name, 'Peraturan'))
                @include('admin.produk_hukum.listdata.formperaturan_edit')
            @elseif($produkHukumCategoryName->category_name == 'Monografi Hukum')
                @include('admin.produk_hukum.listdata.formmonografi_edit')
            @elseif($produkHukumCategoryName->category_name == 'Artikel Hukum')
                @include('admin.produk_hukum.listdata.formartikel_edit')
            @elseif($produkHukumCategoryName->category_name == 'Putusan Pengadilan')
                @include('admin.produk_hukum.listdata.formputusan_edit')
            @endif
            
        </div>
    </form>

    <div class="modal fade" id="tglPembahasanForm" tabindex="-1" role="dialog" aria-labelledby="tglPembahasanForm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-md-10">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tgl Pembahasan</h4>
                </div>

                <div class="modal-body">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="add" id="dynamic-ar" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>&nbsp;Tambah
                    </button>
                    </div>

                    <div>
                        <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Tgl Pembahasan</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="closeForm" class="btn btn-secondary btn-sm">Tutup</button>
                    <button type="button" id="copyToForm" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var y = 0;
        $("#dynamic-documents").click(function () {
            ++y;
            $("#dynamicAddDocuments").append('<tr><td><select name="peraturan_terkait[]" class="form-control"><option value="">-- Pilih Dokumen --</option>@foreach($produkJudulPeraturan as $row)<option value="{{ $row->id }}">{{ $row->judul_peraturan }}</option>@endforeach</select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td></tr>'
                );
        });
        $(document).on('click', '.remove-input-documents', function () {
            $(this).parents('tr').remove();
        });
        
        $("#openFormTglPembahasan").click(function () {
            if($('input[name="tgl_pembahasan"]').val() != '') {
                var tglPembahasanArr = $('input[name="tgl_pembahasan"]').val();
                var arrSplit = tglPembahasanArr.split(',');
                
                $.each(arrSplit, function(index, value) {
                    $("#dynamicAddRemove").append('<tr><td><input data-toggle="datepicker" type="text" value="'+value+'" name="addTglPembahasan[]" class="form-control" style="background-color: white;" readonly /></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-field"><i class="fa fa-times"></i></button></td></tr>'
                    );
                    
                    $('[data-toggle="datepicker"]').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'dd-mm-yy'
                   });
                });
            }
        });

        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input data-toggle="datepicker" type="text" name="addTglPembahasan[]" class="form-control" style="background-color: white;" readonly /></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-field"><i class="fa fa-times"></i></button></td></tr>'
                );
            $('[data-toggle="datepicker"]').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy'
           });
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
        
        $("#closeForm").click(function() {
            $('td').remove();
            $('#tglPembahasanForm').modal('hide');
        });

        $("#copyToForm").click(function() {
            
            var resultTglPembahasan = $('input[name^=addTglPembahasan]').map(function(idx, elem) {
                if($(elem).val() != '')
                return $(elem).val();
            }).get();

            event.preventDefault();

            $('input[name="tgl_pembahasan"]').val(resultTglPembahasan);
            $('td').remove();
            $('#tglPembahasanForm').modal('hide');
        });

        $("#tgl_pengajuan").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

        $("#add_tgl_pembahasan").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

        $("#tgl_penetapan").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

        $("#tgl_pengundangan").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    </script>

@endsection