<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="@yield('seo_tags', 'consiliu, consiliul, national, al, elevilor, scolar, judetean, invatamant, educatie, educatiei, alegeri, vot, voturi, birou, biroul, executiv, presa, cne')">
    <meta name="description" content="@yield('seo_description', 'Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!')">
    <meta name="author" content="Consiliul Național al Elevilor">

    <meta name="theme-color" content="@yield('appbar_hex_color', '#222')">
    <meta name="msapplication-navbutton-color" content="@yield('appbar_hex_color', '#222')">
    <meta name="msapplication-TileColor" content="@yield('appbar_hex_color', '#FFF')">
    <meta name="apple-mobile-web-app-status-bar-style" content="@yield('appbar_hex_color', '#FFF')">
    <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png?v={{ cache('v') }}">

    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('seo_title', 'Alegeri pentru Consiliul Național al Elevilor')" />
    <meta property="og:description"content="@yield('seo_description', 'Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!')" />
    <meta property="og:image" content="@yield('seo_image', '/images/mastheads/masthead-1.jpg')" />

    <meta name="twitter:card" content="summary" />
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">

    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('seo_title', 'Alegeri pentru Consiliul Național al Elevilor')" />
    <meta property="og:description"content="@yield('seo_description', 'Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!')" />
    <meta property="og:image" content="@yield('seo_image', '/images/mastheads/masthead-1.jpg')" />

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png?v={{ cache('v') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png?v={{ cache('v') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png?v={{ cache('v') }}">
    <link rel="manifest" href="/images/favicons/manifest.json">

    <css file="/css/materialdesignicons.css" />
    <css file="/css/animate.css" />
    <css file="/css/noty.css" />
    <css file="/css/noty.relax.css" />
    <css file="/css/argon.css" />
    <css file="/css/custom.css" />

    @yield('css')
    @yield('prejs')

    @if(App::environment('production'))
      <google-analytics :trackingCode="config('services.google.analytics.tracking_id')" />
    @endif

    <title>@yield('title')</title>

    <cookie-consent
      bg="#000" buttonBg="#f1d600" theme="classic"
      message="Nouă ne plac prăjiturelele (cookies). Nu le folosim pentru marketing, ci ne ajută să îți îmbunătățim experiența între platformele noastre."
      dismiss="Am înțeles!"
      question="Ce sunt prăjiturelele?"
      :href="config('app.main_url')"
    />

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/f88358194104b151b39d4a3c2/0634e9727fbd07d409c0533e1.js");</script>
  </head>
  <body>
    <facebook :appId="config('services.facebook.client_id')" version="3.1" />

    @if(!\App::isDownForMaintenance())
      @if(!request()->is('login'))
        <header class="header-global">
          <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
              <a class="navbar-brand mr-lg-5" href="{{ route('home') }}">
                <img alt="Consiliul Național al Elevilor" src="/images/logo/logo-1024-white.png">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navbar">
                <div class="navbar-collapse-header">
                  <div class="row">
                    <div class="col-6 collapse-brand">
                      <a href="{{ route('home') }}">
                        <img alt="Consiliul Național al Elevilor" src="/images/logo/logo-line-black.png">
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
                    <li class="nav-item">
                      <a href="{{ route('users') }}" class="nav-link">
                        <i class="mdi mdi-account mdi-18px"></i> Candidați
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
    @endif

    @yield('content')

    <facebook-messenger :pageId="config('services.facebook.page_id')" />

    @if(!\App::isDownForMaintenance())
      @if(!request()->is('login'))
        <footer class="footer has-cards">
          <div class="container">
            <div class="row row-grid align-items-center my-md">
              <div class="col-lg-6">
                <h3 class="text-primary font-weight-light mb-2">Consiliul Elevilor este online!</h3>
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
            <div class="row align-items-center">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 offset-lg-2">
                <a href="https://sentry.io" target=_blank>
                  <img class="img-fluid" src="/images/sentry-logo-black.png?v={{ cache('v') }}" />
                </a>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <a href="https://algolia.com" target=_blank>
                  <img class="img-fluid" src="/images/algolia-logo.png?v={{ cache('v') }}" />
                </a>
              </div>
            </div>
            <hr>
            <div class="row align-items-center justify-content-md-between">
              <div class="col-md-6">
                <div class="copyright">
                  &copy; {{ now()->format('Y') }}
                  <a href="{{ config('app.main_url') }}" target="_blank">Consiliul Național al Elevilor</a>.
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
    @endif

    <jquery version="3.3.1" />
    <js file="/vendor/popper/popper.min.js" />
    <js file="/vendor/headroom/headroom.min.js" />
    <js file="/vendor/bootstrap/bootstrap.min.js" />
    <js file="/js/noty.js" />
    <js file="/js/jquery.scrollTo.js" />
    <js file="/js/argon.js" />
    <js file="/js/custom.js" />

    <script type="text/javascript">
      $(document).ready(function () {
        @if($errors->any())
          sendNotification('{{ $errors->first() }}', '@mdi('cancel', 'mdi-18px mr-2')', 'error');
        @endif

        @if(Session::has('alert'))
          sendNotification('{{ Session::get('alert') }}', '@mdi('cancel', 'mdi-18px mr-2')', 'error');
        @endif

        @if(Session::has('success'))
          sendNotification('{{ Session::get('success') }}', '@mdi('check', 'mdi-18px mr-2')', 'success');
        @endif
      });
    </script>

    @yield('postjs')
  </body>
</html>
