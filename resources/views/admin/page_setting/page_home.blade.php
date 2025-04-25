@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Home Page Information</h1>
    
    <div class="card shadow mb-4 t-left">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Meta Information</a>
                        <a class="nav-link" id="v-pills-16-tab" data-toggle="pill" href="#v-pills-16" role="tab" aria-controls="v-pills-16" aria-selected="true">Popup SKM</a>
                        <a class="nav-link" id="v-pills-13-tab" data-toggle="pill" href="#v-pills-13" role="tab" aria-controls="v-pills-13" aria-selected="false">Peraturan Section</a>
                        <a class="nav-link" id="v-pills-11-tab" data-toggle="pill" href="#v-pills-11" role="tab" aria-controls="v-pills-11" aria-selected="false">Berita Section</a>
                        <a class="nav-link" id="v-pills-14-tab" data-toggle="pill" href="#v-pills-14" role="tab" aria-controls="v-pills-14" aria-selected="false">Video Section</a>
                        <a class="nav-link" id="v-pills-15-tab" data-toggle="pill" href="#v-pills-15" role="tab" aria-controls="v-pills-15" aria-selected="false">Grafis Section</a>
                        <a class="nav-link" id="v-pills-12-tab" data-toggle="pill" href="#v-pills-12" role="tab" aria-controls="v-pills-12" aria-selected="false">Majalah Section</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">

                            <!-- Tab 1 -->
                            <form action="{{ url('admin/page/home/1') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title *</label>
                                    <input type="text" name="seo_title" class="form-control form-control-sm" value="{{ $page_home->seo_title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta Description *</label>
                                    <textarea name="seo_meta_description" class="form-control form-control-sm h_100" cols="30" rows="10" required>{{ $page_home->seo_meta_description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                            <!-- // Tab 1 -->

                        </div>
                        
                        <div class="tab-pane fade" id="v-pills-16" role="tabpanel" aria-labelledby="v-pills-16-tab">
                            <form action="{{ url('admin/page/home/16') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Survey Slug</label>
                                                <input type="text" name="skm_popup_link" class="form-control form-control-sm" value="{{ $page_home->skm_popup_link }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Show</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="skm_popup_show" id="rr1_skm" value="Once" @if($page_home->skm_popup_show == 'Once') checked @endif>
                                                        <label class="form-check-label font-weight-normal" for="rr1_skm">Once</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="skm_popup_show" id="rr2_skm" value="Unlimited" @if($page_home->skm_popup_show == 'Unlimited') checked @endif>
                                                        <label class="form-check-label font-weight-normal" for="rr2_skm">Unlimited</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="">Status</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="skm_popup_status" id="rr1_skm_stat" value="Show" @if($page_home->skm_popup_status == 'Show') checked @endif>
                                                        <label class="form-check-label font-weight-normal" for="rr1_skm_stat">Show</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="skm_popup_status" id="rr2_skm_stat" value="Hide" @if($page_home->skm_popup_status == 'Hide') checked @endif>
                                                        <label class="form-check-label font-weight-normal" for="rr2_skm_stat">Hide</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>

                        <!-- // JDIH Section -->
                        <div class="tab-pane fade" id="v-pills-13" role="tabpanel" aria-labelledby="v-pills-13-tab">
                            <form action="{{ url('admin/page/home/13') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_photo_peraturan" value="{{ $page_home->peraturan_bg }}">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="peraturan_title" class="form-control form-control-sm" value="{{ $page_home->peraturan_title }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Subtitle</label>
                                                <input type="text" name="peraturan_subtitle" class="form-control form-control-sm" value="{{ $page_home->peraturan_subtitle }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Existing Background</label>
                                                <div><img src="{{ asset('storage/places/'.$page_home->peraturan_bg) }}" alt="" class="w_200"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Change Background</label>
                                                <div><input type="file" name="peraturan_bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="peraturan_status" id="rr1_peraturan_stat" value="Show" @if($page_home->peraturan_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1_peraturan_stat">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="peraturan_status" id="rr2_peraturan_stat" value="Hide" @if($page_home->peraturan_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2_peraturan_stat">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>
                        
                        <div class="tab-pane fade" id="v-pills-14" role="tabpanel" aria-labelledby="v-pills-14-tab">
                            <form action="{{ url('admin/page/home/14') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_photo_video" value="{{ $page_home->video_bg }}">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="video_title" class="form-control form-control-sm" value="{{ $page_home->video_title }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Subtitle</label>
                                                <input type="text" name="video_subtitle" class="form-control form-control-sm" value="{{ $page_home->video_subtitle }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Existing Background</label>
                                                <div><img src="{{ asset('storage/places/'.$page_home->video_bg) }}" alt="" class="w_200"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Change Background</label>
                                                <div><input type="file" name="video_bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="video_status" id="rr1_video_stat" value="Show" @if($page_home->video_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1_video_stat">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="video_status" id="rr2_video_stat" value="Hide" @if($page_home->video_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2_video_stat">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>
                        
                        <div class="tab-pane fade" id="v-pills-11" role="tabpanel" aria-labelledby="v-pills-11-tab">
                            <form action="{{ url('admin/page/home/11') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_photo_artikel" value="{{ $page_home->artikel_bg }}">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="artikel_title" class="form-control form-control-sm" value="{{ $page_home->artikel_title }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Subtitle</label>
                                                <input type="text" name="artikel_subtitle" class="form-control form-control-sm" value="{{ $page_home->artikel_subtitle }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Existing Background</label>
                                                <div><img src="{{ asset('storage/places/'.$page_home->artikel_bg) }}" alt="" class="w_200"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Change Background</label>
                                                <div><input type="file" name="artikel_bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="artikel_status" id="rr1_artikel_stat" value="Show" @if($page_home->artikel_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1_artikel_stat">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="artikel_status" id="rr2_artikel_stat" value="Hide" @if($page_home->artikel_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2_artikel_stat">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>
                        
                        <!-- Grafis Section -->
                        <div class="tab-pane fade" id="v-pills-15" role="tabpanel" aria-labelledby="v-pills-15-tab">
                            <form action="{{ url('admin/page/home/15') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_photo_grafis" value="{{ $page_home->grafis_bg }}">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="grafis_title" class="form-control form-control-sm" value="{{ $page_home->grafis_title }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Subtitle</label>
                                                <input type="text" name="grafis_subtitle" class="form-control form-control-sm" value="{{ $page_home->grafis_subtitle }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Existing Background</label>
                                                <div><img src="{{ asset('storage/places/'.$page_home->grafis_bg) }}" alt="" class="w_200"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Change Background</label>
                                                <div><input type="file" name="grafis_bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="grafis_status" id="rr1_grafis_stat" value="Show" @if($page_home->grafis_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1_grafis_stat">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="grafis_status" id="rr2_grafis_stat" value="Hide" @if($page_home->grafis_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2_grafis_stat">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>
                        
                        <div class="tab-pane fade" id="v-pills-12" role="tabpanel" aria-labelledby="v-pills-12-tab">
                            <form action="{{ url('admin/page/home/12') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_photo_majalah" value="{{ $page_home->artikel_bg }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="majalah_title" class="form-control form-control-sm" value="{{ $page_home->majalah_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Subtitle</label>
                                    <input type="text" name="majalah_subtitle" class="form-control form-control-sm" value="{{ $page_home->majalah_subtitle }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Existing Background</label>
                                    <div><img src="{{ asset('storage/places/'.$page_home->majalah_bg) }}" alt="" class="w_200"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Change Background</label>
                                    <div><input type="file" name="majalah_bg"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="majalah_status" id="rr1_majalah_stat" value="Show" @if($page_home->majalah_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1_majalah_stat">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="majalah_status" id="rr2_majalah_stat" value="Hide" @if($page_home->majalah_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2_majalah_stat">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection