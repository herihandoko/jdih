<div class="theiaStickySidebar">
    <div class="widget feature-mono">
        <form action="{{ url('/frontpage/'.$menu->slug) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="keyword">{{ translateText('Judul') }}</label>
                <input name="keyword" id="keyword" class="form-control form-control-sm my-0 py-1 red-border" type="text" placeholder="{{ translateText('Judul') }}" value="{{ request('keyword') }}">
            </div>

            @if($menu->menu_name != 'Putusan Pengadilan')
            <div class="mb-3">
                <label for="keyword">{{ translateText('Tahun') }}</label>
                <select class="form-control form-control-sm my-0 py-1 red-border" aria-label="Default select example" name="tahun">
                    <option value="0" selected>{{ translateText('semua tahun') }}</option>
                    @foreach($tahun as $val)
                        <option value="{{ $val }}" {{ request('tahun') == $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="mb-3">
                <button class="btn btn-sm btn-primary btn-block btn-sidebar" type="submit" name="form_search">
                    <i class="fa fa-search"></i>&nbsp;{{ translateText('Cari') }}
                </button>

                <a class="btn btn-sm btn-primary btn-block btn-sidebar" href="{{ url('/frontpage/'.$menu->slug) }}">
                    <i class="fa fa-brush"></i>&nbsp;{{ translateText('Reset') }}
                </a>
            </div>
        </form>
    </div>
    <div id="calendar-sidebar" style="max-width: 800px; margin: 50px auto;"></div>
</div>