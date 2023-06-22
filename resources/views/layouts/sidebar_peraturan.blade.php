<div class="sidebar">
    <div>
        <div class="widget feature-mono">
            <form action="{{ url('/produkshukum/search-peraturan') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="keyword">Kata kunci</label>
                    <input name="keyword" id="keyword" class="form-control my-0 py-1 red-border" type="text" placeholder="masukan kata kunci...">
                    <input name="slug" value="{{ $menu->slug }}" type="hidden"></input>
                </div>

                <div class="mb-3">
                    <label for="keyword">Nomor Peraturan</label>
                    <input name="nomor" id="nomor" class="form-control my-0 py-1 red-border" type="text" placeholder="masukan nomor peraturan...">
                </div>

                <div class="mb-3">
                    <label for="keyword">Tahun Peraturan</label>
                    <select class="form-control my-0 py-1 red-border" aria-label="Default select example" name="tahun">
                        <option value="0" selected>semua tahun peraturan</option>
                        @foreach($tahun as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keyword">Bentuk Peraturan</label>
                    <select class="form-control my-0 py-1 red-border" aria-label="Default select example" name="bentuk">
                        <option value="0" selected>semua bentuk peraturan</option>
                        @foreach($bentuk as $val)
                            <option value="{{ $val->id }}">{{ $val->type_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary btn-block" type="submit" name="form_search" style="background-color:#11D694; border-color: #11D694; font-weight: 800;">
                        <i class="fa fa-search"></i>&nbsp;Cari
                    </button>
                    
                    <a class="btn btn-primary btn-block" style="background-color:#11D694; border-color: #11D694; font-weight: 800;" href="{{ url('/produkhukum/'.$menu->slug) }}">
                        <i class="fa fa-brush"></i>&nbsp;Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>