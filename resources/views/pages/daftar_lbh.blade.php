@extends('layouts.app')

@section('content')
<style>
    .card {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s, opacity 0.5s;
        opacity: 0;
    }

    .card.show {
        opacity: 1;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }

    .card-footer .btn {
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        .card-footer .row {
            flex-direction: column;
        }

        .card-footer .col-md-3 {
            width: 100%;
            margin-bottom: 10px;
        }

        .card-footer .col-md-3:last-child {
            margin-bottom: 0;
        }
    }

    /* Flexbox for equal height cards */
    .row-flex {
        display: flex;
        flex-wrap: wrap;
    }

    .row-flex > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }

    /* Dropdown on hover with transition effect */
    .dropdown-menu {
        display: none;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
</style>

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Daftar Lembaga Bantuan Hukum') }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText('Lembaga Bantuan Hukum') }}</p>
    </div>
</div>

<div class="page-content mt_30">
    <div class="container-jdihcontent">
        <div class="row mb-3">
            <div class="col">
                <form id="sortForm" class="form-inline d-flex justify-content-between align-items-center" method="post" action="{{ route('front.daftarlbh') }}">
                    @csrf
                    <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                    <div></div>
                    <div>
                        <div class="input-group">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-sort-amount-up"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" onclick="sortList('name')">Nama</a>
                                    <a class="dropdown-item" href="#" onclick="sortList('address')">Alamat</a>
                                    <a class="dropdown-item" href="#" onclick="sortList('accreditation')">Akreditasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @if( $contentList->count() > 0 )
                @foreach ($contentList as $row)
                <div class="col-lg-4 col-md-6 col-sm-12 order-1 order-lg-0 d-flex">
                    <div class="card w-100 border-warning bg-light shadow">
                        <div class="card-body">
                            <h5 class="card-text text-center">
                                {{ $row->lbh_name }}
                            </h5>
                            <p class="card-text text-center">
                                <small class="text-muted">{{ $row->lbh_address }}</small>
                            </p>
                            <hr>
                            <p class="card-text mb-0">
                                <small class="text-muted">
                                    <i class="fas fa-phone text-success"></i>&nbsp;{{ $row->lbh_phone }}
                                </small>
                            </p>
                            <p class="card-text mb-0">
                                <small class="text-muted text-uppercase">
                                    @if($row->lbh_accreditation)
                                        <i class="fas fa-star text-primary"></i>&nbsp;{{ $row->lbh_accreditation }}&nbsp;{{ "(Akreditasi)" }}
                                    @else
                                        <i class="fas fa-star text-primary"></i>&nbsp;{{ "-" }}
                                    @endif
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @include('pages.no_data')
            @endif
        </div>
        <div class="blog-item mb-3">
            <div>
                {{ $contentList->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function sortList(criteria) {
        document.getElementById('sortInput').value = criteria;
        document.getElementById('sortForm').submit();
    }

    $(document).ready(function(){
        setEqualHeight('.card');

        $(window).resize(function() {
            setEqualHeight('.card');
        });

        function setEqualHeight(selector) {
            var maxHeight = 0;
            $(selector).css('height', 'auto');
            $(selector).each(function() {
                if ($(this).height() > maxHeight) {
                    maxHeight = $(this).height();
                }
            });
            $(selector).height(maxHeight);
        }

        $('.card').each(function(i) {
            setTimeout(function() {
                $('.card').eq(i).addClass('show');
            }, 400 * i);
        });
    });
</script>
@endsection