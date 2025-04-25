@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Video</h1>

    <form action="{{ url('admin/video-gallery/update/'.$video->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Video</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.video.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <iframe class="embed-responsive-item" width="160" height="150" src="https://www.youtube.com/embed/{{ $video->video_youtube }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="">File Video</label>
                            <input type="text" name="video_youtube" class="form-control form-control-sm" value="{{ $video->video_youtube }}" autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Nama Video</label>
                            <input type="text" name="video_caption" class="form-control form-control-sm" value="{{ $video->video_caption }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Urut</label>
                            <input type="number" name="video_order" class="form-control form-control-sm" value="{{ $video->video_order }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="video_status" id="rr1" value="1" @if($video->publish == 1) checked @endif>
                                    <label class="form-check-label font-weight-normal" for="rr1">Publish</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="video_status" id="rr2" value="0" @if($video->publish == 0) checked @endif>
                                    <label class="form-check-label font-weight-normal" for="rr2">Tidak Publish</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-sm btn-success">
                    Ubah
                </button>
            </div>
        </div>
    </form>

@endsection
