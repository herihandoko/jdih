@php
    $general_setting = DB::table('general_settings')->where('id',1)->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Administrator JDIH</title>

    @include('admin.includes.styles')
    
    <link href="{{ asset('storage/places/'.$general_setting->favicon) }}" rel="shortcut icon" type="image/png">

    @include('admin.includes.scripts')

</head>
    <body>
        <section>
        <div class="container-fluid mt-5 pt-5 pl-5 pr-5">
            <div class="row">
                <div class="col-md-6 login-brand">
                    <img src="{{ asset('storage/places/'.$general_setting->login_bg) }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mt-5 login-brand">
                                <img src="{{ asset('storage/places/'.$general_setting->logo) }}" alt="logo" style="width: 150px;" class="logo">
                            </div>
                            <form method="POST" action="{{ route('admin.login.store') }}" class="user" novalidate="">
                                @csrf
                                <div class="form-group first">
                                    <label for="username" class="mb-0">Username</label>
                                    <input id="username" type="username" class="form-control form-control-sm" name="username" tabindex="1" autocomplete="off" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ 'Silakan input username Anda' }}
                                    </div>
                                </div>
                                <div class="form-group last mb-4 password-container">
                                    <label for="password" class="mb-0">Password</label>
                                    <input id="password" type="password" class="form-control form-control-sm" name="password" tabindex="2" autocomplete="off" required>
                                    <span class="password-icon" id="toggle-password">
                                        <i id="password-icon" class="fa fa-eye"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ 'Silakan input password Anda' }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="box-shadow: 0 2px 6px #fd9b96;" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                        {{ 'LOGIN' }}
                                    </button>
                                </div>
                                <div class="text-center text-gray-500">
                                    &mdash; JDIH Provinsi Banten &copy; 2022 &mdash;
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        
        @include('admin.includes.scripts-footer')

    </body>
</html>