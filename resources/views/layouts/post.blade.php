<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
</head>

<body>


    <!-- Navbar -->
    @yield('navbar')
    <!-- /.navbar -->


    <!-- Header -->
    @yield('header')
    <!-- /.header -->


    <!-- Main Content -->
    @yield('content')


    {{-- Comments --}}
    @yield('comments')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row gap-y align-items-center">

                <div class="col-6 col-lg-6">
                    <a href="../index.html"><img src="{{ asset('img/logo-dark.png') }}" alt="logo"></a>
                </div>

                <div class="col-6 col-lg-6 text-right order-lg-last">
                    <div class="social">
                        <a class="social-facebook" href="https://www.facebook.com/RedaAli1997"><i
                                class="fa fa-facebook"></i></a>
                        <a class="social-twitter" href="https://twitter.com/Reda_Ali1997"><i
                                class="fa fa-twitter"></i></a>
                        <a class="social-instagram" href="https://www.instagram.com/reda_ali1997"><i
                                class="fa fa-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- /.footer -->
    <!-- /.footer -->

    <!-- Scripts -->
    <script src="{{ asset('js/page.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d87862f4a322878"></script>

</body>

</html>
