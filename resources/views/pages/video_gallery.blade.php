@extends('layouts.app')

@section('content')

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Galeri Video Youtube') }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText('Video Youtube') }}</p>
    </div>
</div>

<div class="page-content mt_30">
    <div class="container-jdihcontent">
        <div class="row">
            @if( $contentList->count() > 0 )

                @foreach ($contentList as $row)
                <div class="col-lg-4 col-md-6 col-sm-12 order-1 order-lg-0">
                    <div>
                        <img class="img-yt" id="{{ $row->video_youtube }}" src="https://img.youtube.com/vi/{{ $row->video_youtube }}/hqdefault.jpg" width="100%" height="450px" alt="youtube" data-toggle="modal" data-target="#modalYt" data-backdrop="static" data-keyboard="false"/>
                        <p>
                            <h6 class="text-secondary mt-2 small">{{ $row->video_caption }}</h6>
                        </p>
                    </div>
                </div>
                @endforeach
            @else
                @include('pages.no_data')
            @endif
        </div>
        <div class="blog-item mb-3">
            <div>
                {{ $contentList->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalYt" tabindex="-1" role="dialog" aria-labelledby="ytModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0); border: none;">
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" class="close" style="padding: 0rem 1rem; outline: none;" data-dismiss="modal" title="Tutup">
                    <span aria-hidden="true" style="color: #F96B06;">×</span>
                </button>
            </div>
            
            <iframe id="video-yt" style="width: 100%; height: 450px;" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        // Video Youtube
        $("img.img-yt").click(function(e) {
            e.preventDefault();
            var id_yt = $(this).attr('id');
            var src_yt = "https://www.youtube.com/embed/"+id_yt+"?autoplay=1&mute=1&controls=1";
            $("#video-yt").attr("src", src_yt);
        });
        
        $("#modalYt").on("hide.bs.modal", function(e) {
            $("#video-yt").attr("src", "");
        });
    });
</script>
@endsection