<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel Lapse</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    @include('lapse::css')
</head>

<body cz-shortcut-listen="true">

    <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2" href="{{ route('lapse.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="14.31" y1="8" x2="20.05" y2="17.94"></line>
                    <line x1="9.69" y1="8" x2="21.17" y2="8"></line>
                    <line x1="7.38" y1="12" x2="13.12" y2="2.06"></line>
                    <line x1="9.69" y1="16" x2="3.95" y2="6.06"></line>
                    <line x1="14.31" y1="16" x2="2.83" y2="16"></line>
                    <line x1="16.62" y1="12" x2="10.88" y2="21.94"></line>
                </svg>
            </a>
            <a class="py-2 d-none d-md-inline-block" href="{{ route('lapse.index') }}">LAPSE</a>
        </div>
    </nav>

    <div class="limiter">
        <div class="container-table100">
            @yield('content')
        </div>
    </div>

    <footer class="py-5" style="background: #efefef">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">© {{ date('Y') }}</small>
                </div>
                <div class="col-6 col-md">
                    Lapse, Laravel Self Hosted Error Tracking System
                </div>
                <div class="col-6 col-md" style="word-break:break-all">
                    <a href="https://github.com/pyaesone17/lapse" target="_blank">https://github.com/pyaesone17/lapse </a>
                </div>
            </div>
        </div>
    </footer>
    <span id="sbmarwbthv5"></span>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    @stack('js')
</body>

</html>