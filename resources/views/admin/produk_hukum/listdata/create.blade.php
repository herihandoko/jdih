@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Produk Hukum</h1>

    <form action="{{ route('admin.produk_hukum.listdata.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Kategori {{ $produkHukumCategoryName->category_name }}</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.produk_hukum.listdata.jenisdokumen') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-backward"></i> Kembali
                    </a>
                </div>
            </div>
            
            @if(Illuminate\Support\Str::contains($produkHukumCategoryName->category_name, 'Peraturan'))
                @include('admin.produk_hukum.listdata.formperaturan')
            @elseif($produkHukumCategoryName->category_name == 'Monografi Hukum')
                @include('admin.produk_hukum.listdata.formmonografi')
            @elseif($produkHukumCategoryName->category_name == 'Artikel Hukum')
                @include('admin.produk_hukum.listdata.formartikel')
            @elseif($produkHukumCategoryName->category_name == 'Putusan Pengadilan')
                @include('admin.produk_hukum.listdata.formputusan')
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
        
        // Start add row Diubah
        var xy = 0;
        
        $("#dynamic-diubah").click(function () {
            ++xy;
            $("#dynamicAddDiubah").append('<tr><td><select name="peraturan_diubah[]" id="peraturan_diubah'+xy+'" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option></select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-diubah"><i class="fa fa-times"></i></button></td></tr>'
                );
        
            var url = "{{ route('admin.produk_hukum.listdata.select') }}";

            $('#peraturan_diubah'+xy+'').select2({
                ajax:{
                    url: url,
                    dataType: "json",
                    data: (params) => {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };

                        return query;
                    },
                    processResults: data => {
                        return {
                            results: data.data.map((produkHukum) => {
                                return { text: produkHukum.judul_peraturan, id: produkHukum.id };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                },
            });
        });
        $(document).on('click', '.remove-input-diubah', function () {
            $(this).parents('tr').remove();
        });
        // End add row Diubah
        
        // Start add row Mengubah
        var xz = 0;
        
        $("#dynamic-mengubah").click(function () {
            ++xz;
            $("#dynamicAddMengubah").append('<tr><td><select name="peraturan_mengubah[]" id="peraturan_mengubah'+xz+'" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option></select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-mengubah"><i class="fa fa-times"></i></button></td></tr>'
                );
        
            var url = "{{ route('admin.produk_hukum.listdata.select') }}";

            $('#peraturan_mengubah'+xz+'').select2({
                ajax:{
                    url: url,
                    dataType: "json",
                    data: (params) => {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };

                        return query;
                    },
                    processResults: data => {
                        return {
                            results: data.data.map((produkHukum) => {
                                return { text: produkHukum.judul_peraturan, id: produkHukum.id };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                },
            });
        });
        $(document).on('click', '.remove-input-mengubah', function () {
            $(this).parents('tr').remove();
        });
        // End add row Mengubah
        
        // Start add row Dicabut
        var xa = 0;
        
        $("#dynamic-dicabut").click(function () {
            ++xa;
            $("#dynamicAddDicabut").append('<tr><td><select name="peraturan_dicabut[]" id="peraturan_dicabut'+xa+'" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option></select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-dicabut"><i class="fa fa-times"></i></button></td></tr>'
                );
        
            var url = "{{ route('admin.produk_hukum.listdata.select') }}";

            $('#peraturan_dicabut'+xa+'').select2({
                ajax:{
                    url: url,
                    dataType: "json",
                    data: (params) => {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };

                        return query;
                    },
                    processResults: data => {
                        return {
                            results: data.data.map((produkHukum) => {
                                return { text: produkHukum.judul_peraturan, id: produkHukum.id };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                },
            });
        });
        $(document).on('click', '.remove-input-dicabut', function () {
            $(this).parents('tr').remove();
        });
        // End add row Dicabut
        
        // Start add row Mencabut
        var xb = 0;
        
        $("#dynamic-mencabut").click(function () {
            ++xb;
            $("#dynamicAddMencabut").append('<tr><td><select name="peraturan_mencabut[]" id="peraturan_mencabut'+xb+'" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option></select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-mencabut"><i class="fa fa-times"></i></button></td></tr>'
                );
        
            var url = "{{ route('admin.produk_hukum.listdata.select') }}";

            $('#peraturan_mencabut'+xb+'').select2({
                ajax:{
                    url: url,
                    dataType: "json",
                    data: (params) => {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };

                        return query;
                    },
                    processResults: data => {
                        return {
                            results: data.data.map((produkHukum) => {
                                return { text: produkHukum.judul_peraturan, id: produkHukum.id };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                },
            });
        });
        $(document).on('click', '.remove-input-mencabut', function () {
            $(this).parents('tr').remove();
        });
        // End add row Mencabut
        
        // Start add row Peraturan Terkait
        var y = 0;
        
        $("#dynamic-documents").click(function () {
            ++y;
            $("#dynamicAddDocuments").append('<tr><td><select name="peraturan_terkait[]" id="peraturan_terkait_select'+y+'" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option></select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td></tr>'
                );
        
            var url = "{{ route('admin.produk_hukum.listdata.select') }}";

            $('#peraturan_terkait_select'+y+'').select2({
                ajax:{
                    url: url,
                    dataType: "json",
                    data: (params) => {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };

                        return query;
                    },
                    processResults: data => {
                        return {
                            results: data.data.map((produkHukum) => {
                                return { text: produkHukum.judul_peraturan, id: produkHukum.id };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page,
                            },
                        };
                    },
                },
            });
//            $("#dynamicAddDocuments").append('<tr><td><select name="peraturan_terkait[]" class="form-control form-control-sm"><option value="">-- Pilih Dokumen --</option>@foreach($produkJudulPeraturan as $row)<option value="{{ $row->id }}">{{ $row->judul_peraturan }}</option>@endforeach</select></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents"><i class="fa fa-times"></i></button></td></tr>'
//                );
        });
        $(document).on('click', '.remove-input-documents', function () {
            $(this).parents('tr').remove();
        });
        // End add row Peraturan Terkait
        
        // Start add row Dokumen Terkait
        var z = 0;
        
        $("#dynamic-documents-terkait").click(function () {
            ++z;
            $("#dynamicAddDocumentsTerkait").append('<tr><td><input type="file" class="form-control-file" name="file_doc_terkait[]" id="file_doc_terkait'+z+'" accept=".pdf"></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-documents-terkait"><i class="fa fa-times"></i></button></td></tr>'
                );
        });
        $(document).on('click', '.remove-input-documents-terkait', function () {
            $(this).parents('tr').remove();
        });
        // End add row Dokumen Terkait
        
        $("#openFormTglPembahasan").click(function () {
            if($('input[name="tgl_pembahasan"]').val() != '') {
                var tglPembahasanArr = $('input[name="tgl_pembahasan"]').val();
                var arrSplit = tglPembahasanArr.split(',');
                
                $.each(arrSplit, function(index, value) {
                    $("#dynamicAddRemove").append('<tr><td><input data-toggle="datepicker" type="text" value="'+value+'" name="addTglPembahasan[]" class="form-control form-control-sm" style="background-color: white;" readonly /></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-field"><i class="fa fa-times"></i></button></td></tr>'
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
            $("#dynamicAddRemove").append('<tr><td><input data-toggle="datepicker" type="text" name="addTglPembahasan[]" class="form-control form-control-sm" style="background-color: white;" readonly /></td><td><button type="button" class="btn btn-outline-danger btn-sm remove-input-field"><i class="fa fa-times"></i></button></td></tr>'
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