@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Visi dan Misi</h1>

    @if($page_visimisi)
        <form action="{{ url('admin/page-visimisi/update') }}" method="post" enctype="multipart/form-data">
    @else
        <form action="{{ url('admin/page-visimisi/store') }}" method="post" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>

                    @if($page_visimisi)
                        <input type="text" name="name" class="form-control" value="{{ $page_visimisi->name }}" autofocus required>
                    @else
                        <input type="text" name="name" class="form-control" autofocus required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Content</label>

                    @if($page_visimisi)
                        <textarea name="content" class="form-control editor" cols="30" rows="10">{{ $page_visimisi->content }}</textarea>
                    @else
                        <textarea name="content" class="form-control editor" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Existing Picture</label>
                    <div>
                        @if($page_visimisi)
                            <input type="hidden" name="current_picture" value="{{ $page_visimisi->picture }}">
                            <img src="{{ asset('storage/places/'.$page_visimisi->picture) }}" alt="" class="w_300">
                        @else
                            <img alt="" class="w_300">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Change Picture</label>
                    <div>
                        <input type="file" name="picture">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Existing Banner</label>
                    <div>
                        @if($page_visimisi)
                            <input type="hidden" name="current_banner" value="{{ $page_visimisi->banner }}">
                            <img src="{{ asset('storage/places/'.$page_visimisi->banner) }}" alt="" class="w_300">
                        @else
                            <img alt="" class="w_300">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Change Banner</label>
                    <div>
                        <input type="file" name="banner">
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
                        <input type="text" name="seo_title" class="form-control" value="{{ $page_visimisi->seo_title }}">
                    @else
                        <input type="text" name="seo_title" class="form-control">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Meta Description</label>
                    @if($page_visimisi)
                        <textarea name="seo_meta_description" class="form-control h_100" cols="30" rows="10">{{ $page_visimisi->seo_meta_description }}</textarea>
                    @else
                        <textarea name="seo_meta_description" class="form-control h_100" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection