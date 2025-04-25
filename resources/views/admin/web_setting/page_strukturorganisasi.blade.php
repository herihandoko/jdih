@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Struktur Organisasi</h1>

    @if($page_strukturorganisasi)
        <form id="updateStrukturOrganisasi" method="post" enctype="multipart/form-data">
    @else
        <form id="createStrukturOrganisasi" method="post" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>

                    @if($page_strukturorganisasi)
                        <input type="text" name="name" class="form-control" value="{{ $page_strukturorganisasi->name }}" autofocus required>
                    @else
                        <input type="text" name="name" class="form-control" autofocus required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Content</label>

                    @if($page_strukturorganisasi)
                        <textarea id="editorContent" class="form-control form-control-sm" cols="30" rows="10">{!! $page_strukturorganisasi->content !!}</textarea>
                        <div id="divEditorContent" style="display: none;"></div>
<!--                        <textarea name="content" class="form-control editor" cols="30" rows="10">{{ $page_strukturorganisasi->content }}</textarea>-->
                    @else
                        <textarea name="content" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image Saat Ini</label>
                            <div>
                                @if($page_strukturorganisasi)
                                    <input type="hidden" name="current_picture" value="{{ $page_strukturorganisasi->picture }}">
                                    <img src="{{ asset('storage/places/'.$page_strukturorganisasi->picture) }}" alt="" class="w_300">
                                @else
                                    <img alt="" class="w_300">
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ubah Image</label>
                            <div>
                                <input type="file" name="picture" accept=".jpeg, .png, .jpg, .gif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>

                    @if($page_strukturorganisasi)
                        <input type="text" name="seo_title" class="form-control" value="{{ $page_strukturorganisasi->seo_title }}">
                    @else
                        <input type="text" name="seo_title" class="form-control">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Meta Description</label>
                    @if($page_strukturorganisasi)
                        <textarea name="seo_meta_description" class="form-control h_100" cols="30" rows="10">{{ $page_strukturorganisasi->seo_meta_description }}</textarea>
                    @else
                        <textarea name="seo_meta_description" class="form-control h_100" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <button type="submit" class="btn btn-success" id="btnSubmit">Save</button>
            </div>
        </div>
    </form>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#updateStrukturOrganisasi').on('submit', function (e) {
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
                $("#updateStrukturOrganisasi input").removeClass("is-invalid");
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('admin.web_setting.page_strukturorganisasi.update') }}",
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
                                    "Save"
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
                                "Save"
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