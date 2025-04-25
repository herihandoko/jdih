@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Visi dan Misi</h1>

    @if($page_visimisi)
        <form id="updateVisiMisi" method="post" enctype="multipart/form-data">
    @else
        <form id="createVisiMisi" method="post" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="card shadow mb-4" id="visiMisi">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>

                    @if($page_visimisi)
                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $page_visimisi->name }}" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    @else
                        <input type="text" name="name" class="form-control form-control-sm" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Content</label>

                    @if($page_visimisi)
<!--                        <textarea id="txtTiny" name="content_tiny" class="form-control" cols="30" rows="10">{!! $page_visimisi->content !!}</textarea>
                        <input type="text" id="txtReal" name="content" class="form-control editor">-->
                        <textarea id="editorContent" class="form-control form-control-sm" cols="30" rows="10">{!! $page_visimisi->content !!}</textarea>
                        <div id="divEditorContent" style="display: none;"></div>
                    @else
                        <textarea name="content" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image Saat Ini</label>
                            <div>
                                @if($page_visimisi)
                                    <input type="hidden" name="current_picture" value="{{ $page_visimisi->picture }}">
                                    <img src="{{ asset('storage/places/'.$page_visimisi->picture) }}" alt="" class="w_300">
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

                    @if($page_visimisi)
                        <input type="text" name="seo_title" class="form-control form-control-sm" value="{{ $page_visimisi->seo_title }}">
                    @else
                        <input type="text" name="seo_title" class="form-control form-control-sm">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Meta Description</label>
                    @if($page_visimisi)
                        <textarea name="seo_meta_description" class="form-control form-control-sm h_100" cols="30" rows="10">{{ $page_visimisi->seo_meta_description }}</textarea>
                    @else
                        <textarea name="seo_meta_description" class="form-control form-control-sm h_100" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <button type="submit" class="btn btn-success" id="btnSubmit">Save</button>
            </div>
        </div>
    </form>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#updateVisiMisi').on('submit', function (e) {
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
                
//                formData.push({
//                    name: 'content',
//                    value: valhtmlEditorContent
//                });
                
                $(".invalid-feedback").children("strong").text("");
                $("#updateVisiMisi input").removeClass("is-invalid");
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('admin.web_setting.page_visimisi.update') }}",
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