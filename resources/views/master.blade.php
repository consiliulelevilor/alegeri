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

    <link rel="stylesheet" href="{{ asset('/css/argon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

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
    
    @if(!request()->is('login'))
      <header class="header-global">
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
          <div class="container">
            <a class="navbar-brand mr-lg-5" href="{{ route('home') }}">
              <img src="{{ asset('images/logo/logo-1024-white.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
              <div class="navbar-collapse-header">
                <div class="row">
                  <div class="col-6 collapse-brand">
                    <a href="{{ route('home') }}">
                      <img src="{{ asset('images/logo/logo-line-black.png') }}">
                    </a>
                  </div>
                  <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                      <span></span>
                      <span></span>
                    </button>
                  </div>
                </div>
              </div>
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
              </ul>
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
                @auth
                  <li class="nav-item d-lg-block ml-lg-4">
                    <a href="{{ route('me') }}" class="btn btn-success">
                      <span class="nav-link-inner--text">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                      Deconectare
                    </a>
                  </li>
                @endauth
                @guest
                  <li class="nav-link">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                      Login
                    </a>
                  </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
      </header>
    @endif

    @yield('content')

    @if(!request()->is('login'))
      <footer class="footer has-cards">
        <div class="container">
          <div class="row row-grid align-items-center my-md">
            <div class="col-lg-6">
              <h3 class="text-primary font-weight-light mb-2">Consiliul Elevilor este online.</h3>
              <h4 class="mb-0 font-weight-light">Ne găsești oricând pe social media.</h4>
            </div>
            <div class="col-lg-6 text-lg-center btn-wrapper">
              <a target="_blank" href="https://instagram.com/consilulelevilor" class="btn btn-neutral btn-icon-only btn-instagram btn-round btn-lg" data-toggle="tooltip" data-original-title="Urmărește-ne pe Instagram!">
                <i class="mdi mdi-instagram"></i>
              </a>
              <a target="_blank" href="https://www.facebook.com/consilulelevilor" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" data-original-title="Dă-ne un like pe Facebook!">
                <i class="mdi mdi-facebook-box"></i>
              </a>
            </div>
          </div>
          <hr>
          <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
              <div class="copyright">
                &copy; {{ now()->format('Y') }}
                <a href="{{ env('MAIN_URL') }}" target="_blank">Consiliul Național al Elevilor</a>.
              </div>
            </div>
            <div class="col-md-6">
              <ul class="nav nav-footer justify-content-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">Despre noi</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link">Echipa</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    @endif

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/headroom/headroom.min.js') }}"></script>
    <script src="{{ asset('/js/argon.min.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        //
      });
    </script>
    @yield('js')
  </body>
</html>