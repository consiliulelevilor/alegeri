@extends('master')

@section('title', 'Login')

@section('content')
  <main>
    <section class="login section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container pt-lg-md">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
            <div class="card bg-secondary shadow border-0">
              <div class="loader-background" id="loader">
                <div class="loader"></div>
              </div>
              <div class="card-header bg-white pb-5">
                <div class="text-muted text-center mt-4 mb-3">
                  Conectează-te în contul tău de candidat.
                </div>
                <div class="btn-wrapper text-center">
                  <a href="{{ route('social', ['social' => 'facebook']) }}" class="btn btn-facebook btn-icon">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-facebook-box"></i>
                    </span>
                  </a>
                  <a href="{{ route('social', ['social' => 'google']) }}" class="btn btn-google-plus btn-icon">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-google"></i>
                    </span>
                  </a>
                  <a href="{{ route('social', ['social' => 'instagram']) }}" class="btn btn-instagram btn-icon">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-instagram"></i>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <a href="javascript:{}" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Fiind o aplicație destinată adolescenților, este foarte puțin probabil ca cineva să nu aibă un cont pe social media." class="text-light">
                  <small>De ce nu acceptăm și alte metode?</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#loader').hide();

      $('a.btn').on('click', function(e) {
        $('#loader').fadeIn();
      });
    });
  </script>
@endsection

@section('css')

@endsection