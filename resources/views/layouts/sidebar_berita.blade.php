<div class="theiaStickySidebar">
    <div class="widget feature-mono">
        <h3>{{ translateText('Berita Lainnya') }}</h3>
        <div class="type-2">
            <ul>
                @php $i=0 @endphp
                @foreach($beritaList as $row)
                    @php $i++ @endphp
                    @if($i > $g_setting->sidebar_total_recent_post)
                        @break
                    @endif
                    <li>
                        @if($row->photo_berita)
                            <img class="card-img-top rounded" style="box-shadow: 3px 3px 5px grey;" src="{{ url('storage/places/berita/'.$row->photo_berita) }}" alt="Foto Berita">
                        @else
                            <img class="card-img-top rounded" src="{{ url('storage/places/berita/logo-berita.png') }}" alt="Foto Berita">
                        @endif
                        
                        <a class="text-dark hover-text-primary text-capitalize mb-1" href="{{ url('berita/'.$row->slug) }}" style="font-size: 11px !important;">
                            {{ translateText($row->judul_berita) }}
                        </a>
                    </li>
                    <hr/ style="background: transparent !important;">
                @endforeach
            </ul>
        </div>
    </div>
</div>
