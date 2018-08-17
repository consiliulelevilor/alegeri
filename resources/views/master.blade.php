<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="google-site-verification" content="" />

        <meta name="theme-color" content="#000aee">
        <meta name="msapplication-navbutton-color" content="#000aee">
        <meta name="msapplication-TileColor" content="#000aee">
        <meta name="apple-mobile-web-app-status-bar-style" content="#000aee">
        <meta name="msapplication-TileImage" content="http://via.placeholder.com/350x150">

        <meta property="og:url" content="{{ request()->url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="" />
        <meta property="og:description"content="" />
        <meta property="og:image" content="{{ asset('/images/renoki-as-open-source-renoki.png') }}" />

        <meta name="twitter:card" content="summary"></meta>
        <meta name="twitter:creator" content="@rennokki"></meta>

        <meta property="fb:app_id" content="{{ env('FACEBOOK_ID') }}">

        <link rel="apple-touch-icon" sizes="57x57" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="60x60" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="72x72" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="76x76" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="114x114" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="120x120" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="144x144" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="152x152" href="http://via.placeholder.com/350x150">
        <link rel="apple-touch-icon" sizes="180x180" href="http://via.placeholder.com/350x150">
        <link rel="icon" type="image/png" sizes="192x192" href="http://via.placeholder.com/350x150">
        <link rel="icon" type="image/png" sizes="32x32" href="http://via.placeholder.com/350x150">
        <link rel="icon" type="image/png" sizes="96x96" href="http://via.placeholder.com/350x150">
        <link rel="icon" type="image/png" sizes="16x16" href="http://via.placeholder.com/350x150">
        <link rel="manifest" href="{{ asset('/images/favicons/manifest.json') }}">

        <link rel="stylesheet" href="{{ asset('/css/semantic.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script defer src="{{ asset('/js/semantic.min.js') }}"></script>

        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">

        @yield('css')

        @if(App::environment('production'))
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113007363-2"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'UA-113007363-2');
            </script>
        @endif

        <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

        <title>@yield('title')</title>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            @if(App::environment('production'))
                window.fbAsyncInit = function() {
                    FB.init({
                        appId: '{{ env('FACEBOOK_ID') }}',
                        cookie: true,
                        xfbml: true,
                        version: 'v3.1'
                    });
                
                    FB.AppEvents.logPageView();  
                };
            @endif
        </script>

        <div class="ui vertical inverted sidebar menu">
            <a class="active item">Home</a>
            <a class="item">Work</a>
            <a class="item">Company</a>
            <a class="item">Careers</a>
            <a class="item">Login</a>
            <a class="item">Signup</a>
        </div>

        <div class="pusher">
            @yield('content')
        </div>

        <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function($) {
                $('.ui.sidebar').sidebar('attach events', '.toc.item');
            });
        </script>

        @yield('js')
    </body>
</html>