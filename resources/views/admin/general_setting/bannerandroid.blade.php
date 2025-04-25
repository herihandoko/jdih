@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Edit Banner Android</h1>

<form action="{{ url('admin/setting/general/bannerandroid/update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="current_photo" value="{{ $general_setting->banner_android }}">

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group">
                <label for="">Existing Banner Android</label>
                <div>
                    <img src="{{ asset('storage/places/'.$general_setting->banner_android) }}" alt="" class="w_200">
                </div>
            </div>
            <div class="form-group">
                <label for="">Change Banner Android</label>
                <div>
                    <input type="file" name="banner_android" accept=".jpeg, .png, .jpg, .gif">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>

@endsection