<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="consiliu, consiliul, national, al, elevilor, scolar, judetean, invatamant, educatie, educatiei, alegeri, vot, voturi, birou, biroul, executiv, presa, cne">
    <meta name="description" content="Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!">
    <meta name="author" content="Consiliul Național al Elevilor">

    <meta name="theme-color" content="#222">
    <meta name="msapplication-navbutton-color" content="#222">
    <meta name="msapplication-TileColor" content="#FFF">
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFF">
    <meta name="msapplication-TileImage" content="{{ asset('/images/favicons/ms-icon-144x144.png') }}?v={{ cache('v') }}">

    <meta name="twitter:card" content="summary"></meta>
    <meta name="twitter:creator" content="@rennokki"></meta>

    <meta property="fb:app_id" content="{{ env('FACEBOOK_ID') }}">

    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Alegeri pentru Consiliul Național al Elevilor" />
    <meta property="og:description"content="Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!" />
    <meta property="og:image" content="{{ asset('/images/mastheads/masthead-1.jpg') }}" />

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/images/favicons/apple-icon-57x57.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/images/favicons/apple-icon-60x60.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/images/favicons/apple-icon-72x72.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/images/favicons/apple-icon-76x76.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/images/favicons/apple-icon-114x114.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/images/favicons/apple-icon-120x120.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/images/favicons/apple-icon-144x144.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/images/favicons/apple-icon-152x152.png') }}?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/favicons/apple-icon-180x180.png') }}?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/images/favicons/android-icon-192x192.png') }}?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicons/favicon-32x32.png') }}?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/favicons/favicon-96x96.png') }}?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicons/favicon-16x16.png') }}?v={{ cache('v') }}">
    <link rel="manifest" href="{{ asset('/images/favicons/manifest.json') }}">

    <link rel="stylesheet" href="{{ asset('/css/argon.min.css') }}?v={{ cache('v') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}?v={{ cache('v') }}">
    <link rel="stylesheet" href="{{ asset('/css/noty.css') }}?v={{ cache('v') }}">
    <link rel="stylesheet" href="{{ asset('/css/relax.css') }}?v={{ cache('v') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}?v={{ cache('v') }}">

    <link rel="stylesheet" href="{{ asset('/css/materialdesignicons.min.css') }}?v={{ cache('v') }}">

    @yield('css')

    @if(App::environment('production'))
      <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
      </script>
    @endif

    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
      window.addEventListener("load", function(){
      window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#000"
          },
          "button": {
            "background": "#f1d600"
          }
        },
        "theme": "classic",
        "content": {
          "message": "Nouă ne plac prăjiturelele (cookies).\nNu le folosim pentru marketing, ci ne ajută să îți îmbunătățim experiența între platformele noastre.",
          "link": "Ce sunt prăjiturelele?"
        }
      })});
    </script>
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
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand mr-lg-5" href="{{ route('home') }}">
              <img alt="Consiliul Național al Elevilor" src="{{ asset('images/logo/logo-1024-white.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
              <div class="navbar-collapse-header">
                <div class="row">
                  <div class="col-6 collapse-brand">
                    <a href="{{ route('home') }}">
                      <img alt="Consiliul Național al Elevilor" src="{{ asset('images/logo/logo-line-black.png') }}">
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
                @auth
                  <li class="nav-item">
                    <a href="{{ route('campaigns') }}" class="nav-link text-warning">
                      <i class="mdi mdi-share mdi-18px"></i> Aplică
                    </a>
                  </li>
                @endauth
              </ul>
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
                @auth
                  <li class="nav-item">
                    <a href="{{ route('me') }}" class="nav-link">
                      <i class="mdi mdi-account-circle mdi-18px"></i> {{ Auth::user()->name }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                      <i class="mdi mdi-logout mdi-18px"></i> Deconectare
                    </a>
                  </li>
                @endauth
                @guest
                  <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-success">
                      <i class="mdi mdi-login mdi-18px"></i> Autentificare
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
            <div class="col-lg-6 text-center btn-wrapper">
              <a target="_blank" href="https://instagram.com/consiliulelevilor" class="btn btn-neutral btn-md btn-instagram" data-toggle="tooltip" data-original-title="Urmărește-ne pe Instagram!">
                <span class="btn-inner--icon">
                  <i class="mdi mdi-instagram mdi-24px"></i>
                </span>
              </a>
              <a target="_blank" href="https://facebook.com/consiliulelevilor" class="btn btn-neutral btn-md btn-facebook" data-toggle="tooltip" data-original-title="Dă-ne un like pe Facebook!">
                <span class="btn-inner--icon">
                  <i class="mdi mdi-facebook-box mdi-24px"></i>
                </span>
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
                {{-- <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">Despre noi</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link">Echipa</a>
                </li> --}}
              </ul>
            </div>
          </div>
        </div>
      </footer>
    @endif

    <script src="{{ asset('/js/jquery.min.js') }}?v={{ cache('v') }}"></script>
    <script src="{{ asset('/vendor/popper/popper.min.js') }}?v={{ cache('v') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/bootstrap.min.js') }}?v={{ cache('v') }}"></script>
    <script src="{{ asset('/vendor/headroom/headroom.min.js') }}?v={{ cache('v') }}"></script>
    <script src="{{ asset('/js/argon.min.js') }}?v={{ cache('v') }}"></script>
    <script src="{{ asset('/js/noty.min.js') }}?v={{ cache('v') }}"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        @if($errors->any())
          new Noty({
            layout: 'topCenter',
            type: 'error',
            text: '<i class="mdi mdi-cancel mdi-18px mr-2"></i> {{ $errors->first() }}',
            theme: 'relax',
            timeout: 10000,
            animation: {
              open: 'animated fadeInDown',
              close: 'animated fadeOutUp',
            },
          }).show();
        @endif
        @if(Session::has('alert') || Session::has('success'))
          new Noty({
            layout: 'topCenter',
            @if(Session::has('alert'))
              type: 'error',
              text: '<i class="mdi mdi-cancel mdi-18px mr-2"></i> {{ Session::get('alert') }}',
            @endif
            @if(Session::has('success'))
              type: 'success',
              text: '<i class="mdi mdi-check mdi-18px mr-2"></i> {{ Session::get('success') }}',
            @endif
            theme: 'relax',
            timeout: 6000,
            animation: {
              open: 'animated fadeInDown',
              close: 'animated fadeOutUp',
            },
          }).show();
        @endif
      });
    </script>
    @yield('js')
  </body>
</html>