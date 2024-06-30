<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Reset Password | FamCraft Technologies</title>

        <meta name="keywords" content="FamCraft Technologies, NIN services, Airtime, Data, Cable TV" />
        <meta name="description" content="FamCraft Technologies, NIN services, Airtime, Data, Cable TV">
        <meta name="author" content="famcraft.ng">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('img/logos/favicon.png') }}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{ asset('img/logos/favicon.png') }}">

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/vendor/animate/animate.compat.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
        
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/theme.css') }}" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/skins/default.css') }}" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

        <!-- Head Libs -->
        <script src="{{ asset('admin/vendor/modernizr/modernizr.js') }}"></script>

    </head>

    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', 'Error');
        </script>
    @endif

    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo float-start">
                    <img src="{{ asset('img/logos/logo.png') }}" height="70" alt="FamCraft Technologies" />
                </a>

                <div class="panel card-sign">
                    <div class="card-title-sign mt-3 text-end">
                        <h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Reset Password</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <input id="email" name="email" type="email" class="form-control form-control-lg" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                    <span class="input-group-text">
                                        <i class="bx bx-user text-4"></i>
                                    </span>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control form-control-lg" required autocomplete="new-password" />
                                    <span class="input-group-text">
                                        <i class="bx bx-lock text-4"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-lg" required autocomplete="new-password" />
                                    <span class="input-group-text">
                                        <i class="bx bx-lock text-4"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary mt-2">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-3 mb-3">FamCraft Technologies &copy; Copyright 2024. All Rights Reserved.</p>
            </div>
        </section>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="{{ asset('admin/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('admin/vendor/popper/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('admin/vendor/common/common.js') }}"></script>
        <script src="{{ asset('admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ asset('admin/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

        <!-- Specific Page Vendor -->

        <!-- Theme Base, Components and Settings -->
        <script src="{{ asset('admin/js/theme.js') }}"></script>

        <!-- Theme Custom -->
        <script src="{{ asset('admin/js/custom.js') }}"></script>

        <!-- Theme Initialization Files -->
        <script src="{{ asset('admin/js/theme.init.js') }}"></script>

    </body>
</html>
