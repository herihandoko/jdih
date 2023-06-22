<div class="sidebar">
    <div>
        <div class="widget feature-mono">
            <form action="{{ url('search-majalah-hukum') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="keyword">Kata kunci</label>
                    <input name="keyword" id="keyword" class="form-control my-0 py-1 red-border" type="text" placeholder="masukan kata kunci...">
                </div>

                <div class="mb-3">
                    <label for="keyword">Tahun Terbit</label>
                    <select class="form-control my-0 py-1 red-border" aria-label="Default select example" name="tahun">
                        <option value="0" selected>semua tahun terbit</option>
                        @foreach($tahun as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keyword">Penerbit</label>
                    <select class="form-control my-0 py-1 red-border" aria-label="Default select example" name="penulis">
                        <option value="0" selected>semua penerbit</option>
                        @foreach($penerbit as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary btn-block" type="submit" name="form_search" style="background-color:#11D694; border-color: #11D694;">
                        <i class="fa fa-search"></i>&nbsp;Cari
                    </button>
                    
                    <a class="btn btn-primary btn-block" style="background-color:#11D694; border-color: #11D694;" href="{{ url('majalah-hukum') }}">
                        <i class="fa fa-brush"></i>&nbsp;Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>