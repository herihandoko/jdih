<div class="theiaStickySidebar">
    <div class="widget feature-mono">
        <form action="{{ url('/produkhukum/'.$menu->slug) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="keyword">{{ translateText('Judul') }}</label>
                <input name="keyword" id="keyword" class="form-control form-control-sm my-0 py-1 red-border" type="text" placeholder="{{ translateText('Judul') }}" value="{{ request('keyword') }}">
            </div>

            <div class="mb-3">
                <label for="keyword">{{ translateText('Nomor Peraturan') }}</label>
                <input name="nomor" id="nomor" class="form-control form-control-sm my-0 py-1 red-border" type="text" placeholder="{{ translateText('Nomor Peraturan') }}" value="{{ request('nomor') }}">
            </div>

            <div class="mb-3">
                <label for="keyword">{{ translateText('Tahun Peraturan') }}</label>
                <select class="form-control form-control-sm my-0 py-1 red-border" aria-label="Default select example" name="tahun">
                    <option value="0" selected>{{ translateText('semua tahun') }}</option>
                    @foreach($tahun as $val)
                        <option value="{{ $val }}" {{ request('tahun') == $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>

<!--                <div class="mb-3">
                <label for="keyword">Bentuk Peraturan</label>
                <select class="form-control my-0 py-1 red-border" aria-label="Default select example" name="bentuk">
                    <option value="0" selected>semua bentuk peraturan</option>
                    @foreach($bentuk as $val)
                        <option value="{{ $val->id }}">{{ $val->type_name }}</option>
                    @endforeach
                </select>
            </div>-->

            <div class="mb-3">
                <button class="btn btn-sm btn-block btn-sidebar" type="submit" name="form_search">
                    <i class="fa fa-search"></i>&nbsp;{{ translateText('Cari') }}
                </button>

                <a class="btn btn-sm btn-block btn-sidebar" href="{{ url('/produkhukum/'.$menu->slug) }}">
                    <i class="fa fa-brush"></i>&nbsp;{{ translateText('Reset') }}
                </a>
            </div>
        </form>
    </div>
</div>