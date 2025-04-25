@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Dasar Hukum</h1>

    @if($page_dasarhukum)
        <form id="updateDasarHukum" method="post" enctype="multipart/form-data">
    @else
        <form id="createDasarHukum" method="post" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="card shadow mb-4" id="dasarHukum">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Content</label>

                    @if($page_dasarhukum)
                        <textarea id="editorContent" class="form-control form-control-sm" cols="30" rows="10">{!! $page_dasarhukum->content !!}</textarea>
                        <div id="divEditorContent" style="display: none;"></div>
                    @else
                        <textarea id="editorContent" name="content" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                        <div id="divEditorContentCreate" style="display: none;"></div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">File Saat Ini</label>
                            <div>
                                @if($page_dasarhukum)
                                    <input type="hidden" name="current_file" value="{{ $page_dasarhukum->file }}">
                                    <embed type="application/pdf" src="{{ url('storage/places/dasar_hukum/'.$page_dasarhukum->file) }}#scrollbar=0" style="height: 400px; width: 100%;" class="hidden-xs">
                                @else
                                    <img alt="" class="w_300">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ubah File</label>
                            <div>
                                <input type="file" name="file" accept=".pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <button type="submit" class="btn btn-success" id="btnSubmit">Simpan</button>
            </div>
        </div>
    </form>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#createDasarHukum').on('submit', function (e) {
                e.preventDefault();
                $("#btnSubmit").prop("disabled", true);
                $("#btnSubmit").html(
                        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Proses..."
                );
        
                var valEditorContentCreate = tinymce.get('editorContent').getContent();
                $('#divEditorContentCreate').text(valEditorContentCreate);
                var valhtmlEditorContentCreate = $('#divEditorContentCreate').html();

                var formData = new FormData(this);
                formData.append('content',valhtmlEditorContentCreate);
                
                $(".invalid-feedback").children("strong").text("");
                $("#createDasarHukum input").removeClass("is-invalid");
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('admin.web_setting.page_dasarhukum.store') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: (response) => {
                        Swal.fire(
                            'Informasi!',
                            'Data berhasil ditambah',
                            'success'
                        ).then((result)=>{
                            $("#btnSubmit").html(
                                    "Simpan"
                            );
                            $("#btnSubmit").prop("disabled", false);
                            window.location.reload();
                        });
                    },
                    error: (response) => {
                        if(response.status === 422) {
                            var errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });

                            $("#btnSubmit").html(
                                "Simpan"
                            );
                            $("#btnSubmit").prop("disabled", false);
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
            
            $('#updateDasarHukum').on('submit', function (e) {
                e.preventDefault();
                $("#btnSubmit").prop("disabled", true);
                $("#btnSubmit").html(
                        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Proses..."
                );
        
                var valEditorContent = tinymce.get('editorContent').getContent();
                $('#divEditorContent').text(valEditorContent);
                var valhtmlEditorContent = $('#divEditorContent').html();

                var formData = new FormData(this);
                formData.append('content',valhtmlEditorContent);
                
                $(".invalid-feedback").children("strong").text("");
                $("#updateDasarHukum input").removeClass("is-invalid");
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('admin.web_setting.page_dasarhukum.update') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: (response) => {
                        Swal.fire(
                            'Informasi!',
                            'Data berhasil diubah',
                            'success'
                        ).then((result)=>{
                            $("#btnSubmit").html(
                                    "Simpan"
                            );
                            $("#btnSubmit").prop("disabled", false);
                            window.location.reload();
                        });
                    },
                    error: (response) => {
                        if(response.status === 422) {
                            var errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });

                            $("#btnSubmit").html(
                                "Simpan"
                            );
                            $("#btnSubmit").prop("disabled", false);
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection