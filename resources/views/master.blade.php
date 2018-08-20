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

        <div class="ui vertical sidebar menu">
            <div class="item">
                <div class="ui right aligned">
                    <a href="javascript:{}" id="close-sidebar-button" class="sidebar close"><i class="mdi mdi-close mdi-36px"></i></a>
                </div>
            </div>
            @auth
                <div class="item">
                    <div class="header">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                    <div class="menu">
                        <a href="{{ route('me') }}" class="item">Profilul meu</a>
                        <a href="{{ route('logout') }}" class="item">Deconectare</a>  
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="item"><i class="fa fa-user-tie"></i> &nbsp; Zona candidaților</a>
            @endguest
        </div>

        <div class="pusher">
            @if(!request()->is('/'))
                <div class="ui centered grid">
                    <div class="column fifteen wide">
                        <div class="ui container">
                            <div class="ui master large secondary inverted text menu">
                                <a class="toc item">
                                    <i class="mdi mdi-menu mdi-36px"></i>
                                </a>
                                <div class="item logo">
                                    <img src="{{ asset('/images/logo/logo-1024-white.png') }}">
                                </div>

                                <div class="right item">
                                    @auth
                                        <img src="{{ Auth::user()->avatarUrl() }}">
                                        &nbsp;
                                        <a href="{{ route('me') }}" class="item">Profilul meu</a>
                                        <a href="{{ route('logout') }}" class="item">Deconectare</a>
                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}" class="ui inverted button"><i class="fa fa-user-tie"></i> &nbsp; Zona candidaților</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif             
            @yield('content')
        </div>

        <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function($) {
                $('.ui.sidebar').sidebar('attach events', '.toc.item');

                $('#close-sidebar-button').on('click', function(e) {
                    $('.ui.sidebar').sidebar('toggle');
                });
            });
        </script>

        @yield('js')
    </body>
</html>