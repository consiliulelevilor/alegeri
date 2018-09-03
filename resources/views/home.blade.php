@extends('master')

@section('title', 'Alegeri pentru Consiliul Național al Elevilor')

@section('content')
  <main>
    <div class="position-relative">
      <section class="masthead section section-lg section-shaped pb-250" style="background-image: url({{ asset('/images/ag-8.jpg') }});" id="masthead">
        <div class="shape shape-style-1 shape-default">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container py-lg-md d-flex">
          <div class="col px-0 pt-5">
            <div class="row">
              <div class="col-lg-6">
                <h1 class="display-3 text-white">
                  Ce mai aștepți?
                  <span>
                    E timpul să devii chiar tu vocea colegilor tăi.
                  </span>
                </h1>
                <p class="lead  text-white">
                  Implică-te în Consiliul Școlar al Elevilor, structura de reprezentare a elevilor din școala ta!
                </p>
                <div class="btn-wrapper">
                  <a href="javascript:{}" id="more-button" class="btn btn-success btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="mdi mdi-arrow-right  mdi-18px"></i></span>
                    <span class="btn-inner--text">Citește mai mult</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
    </div>
    <section class="section section-lg pt-5 pb-0 mt--600" id="section-0">
      <div class="container">
        <div class="row row-grid align-items-center">
          <div class="col-md-6">
            <div class="card bg-default shadow border-0">
              <img src="{{ asset('images/ag-5.jpg') }}" class="card-img-top">
              <blockquote class="card-blockquote">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="svg-bg">
                  <polygon points="0,52 583,95 0,95" class="fill-default" />
                  <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default" />
                </svg>
                <h4 class="display-3 font-weight-bold text-white">
                  Adunări generale
                </h4>
                <p class="lead text-italic text-white">
                  Anual, CNE organizează Adunări Generale, în care reprezentanții elevilor din toată țara dezbat subiecte de interes pentru sistemul de învățământ.
                </p>
              </blockquote>
            </div>
          </div>
          <div class="col-md-6">
            <div class="pl-md-5">
              <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5">
                <i class="mdi mdi-account-supervisor-circle"></i>
              </div>
              <h3>
                Cine suntem și ce facem?
              </h3>
              <p class="lead">
                Consiliul Școlar al Elevilor este organismul care militează pentru respectarea drepturilor elevilor la nivelul unității de învățământ preuniversitar.
              </p>
              <p>
                Mai mult decât atât, ca membru CȘE, vei avea ocazia să te implici în procesul decizional și să contribui, alături de colegii tăi, la transformarea pozitivă a climatului educațional la nivelul școlii tale.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section pt-5 mt-3 pb-2" id="section-2">
      <div class="container">
        <div class="row row-grid align-items-center">
          <div class="col-md-6 order-md-2">
            <img src="{{ asset('images/ag-11.jpg') }}" class="img-fluid">
          </div>
          <div class="col-md-6 order-md-1">
            <div class="pr-md-5">
              <div class="icon icon-lg icon-shape icon-shape-danger shadow rounded-circle mb-5">
                <i class="mdi mdi-food-apple"></i>
              </div>
              <h3>Posturi vacante!</h3>
              <p>
                Te vrem în echipa noastră. Toate funcțiile vacante pot fi vizualizate și poți
                aplica pentru una dintre acestea direct de pe platforma noastră de alegeri. 
              </p>
              <p>
                Îți punem la dispoziție trei secțiuni unde poți aplica liber!
              </p>
              <ul class="list-unstyled mt-5">
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-success mr-3">
                        <i class="mdi mdi-sitemap"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Consiliul Național al Elevilor</h6>
                    </div>
                  </div>
                </li>
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-primary mr-3">
                        <i class="mdi mdi-map-marker"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Consiliul Județean al Elevilor</h6>
                    </div>
                  </div>
                </li>
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-danger mr-3">
                        <i class="mdi mdi-city-variant-outline"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Consiliul Școlar al Elevilor
                          <span class="badge badge-pill badge-primary text-uppercase">În curând</span>
                      </h6>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg mt-2" id="section-3">
      <div class="container">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-10 text-left">
            <h2 class="display-3">
              Îți place la noi?
              <span class="text-danger">Poate fi "dragoste la prima aplicație"! <i class="mdi mdi-heart text-danger ml-1"></i></span>
            </h2>
            <p class="lead">
                Suntem convinși de faptul că, cel puțin o dată în viața ta de elev, te-ai confruntat cu un abuz în mediul școlar,
                abuz care te-a motivat să crezi că există o multitudine de aspecte în sistemul de învățământ care trebuie să fie reglementate,
                pentru binele nostru, al principalilor beneficiari ai educației. 
            </p>
            <p>
              Reprezentanții elevilor la nivel județean sunt cei care militează pentru respectarea drepturilor
              și intereselor elevilor din județul respectiv, precum și pentru solidificarea parteneriatului dintre elevi și decidenți.
            </p>
            <div class="btn-wrapper">
              <a href="{{ (Auth::user()) ? route('campaigns') : route('login') }}" class="btn btn-danger mt-3">
                <i class="mdi mdi-heart mr-2"></i> Depune aplicația ta!
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@section('js')
  <script src="{{ asset('/js/jquery-scrollTo.min.js') }}?v={{ cache('v') }}"></script>

  <script type="text/javascript">
      $(document).ready(function() {
        $('#more-button').on('click', function (e) {
          $(window).scrollTo($('#section-0'), 1000);
        });
      });
  </script>
@endsection

@section('css')

@endsection