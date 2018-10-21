@extends('master')

@section('title', 'Login - Alegeri pentru Consiliul Național al Elevilor')

@section('css')
@endsection

@section('prejs')
@endsection

@section('postjs')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#loader').hide();

      $('a.btn:not(#back-button)').on('click', function (e) {
        $('#loader').fadeIn();
      });
    });
  </script>
@endsection

@section('content')
  <main>
    <section class="login section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-danger">
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
            <a href="{{ route('home') }}" id="back-button" class="btn btn-md btn-dark mb-3">
              <i class="mdi mdi-arrow-left mr-2"></i> Înapoi
            </a>
            <div class="card bg-secondary shadow border-0">
              <div class="loader-background" id="loader">
                <div class="loader"></div>
              </div>
              <div class="card-header bg-white pb-5 pt-5">
                <div class="btn-wrapper text-center">
                  <a href="{{ route('social', ['social' => 'facebook']) }}" class="btn btn-block btn-facebook">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-facebook-box mdi-18px mr-2"></i> Autentificare cu Facebook
                    </span>
                  </a>
                  <a href="{{ route('social', ['social' => 'google']) }}" class="btn btn-block btn-google-plus">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-google mdi-18px mr-2"></i> Autentificare cu Google
                    </span>
                  </a>
                  <a href="{{ route('social', ['social' => 'instagram']) }}" class="btn btn-block btn-instagram">
                    <span class="btn-inner--icon">
                      <i class="mdi mdi-instagram mdi-18px mr-2"></i> Autentificare cu Instagram
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <a href="javascript:{}" data-container="body" data-toggle="tooltip" data-placement="top" title="Fiind o aplicație destinată adolescenților, este foarte puțin probabil ca cineva să nu aibă un cont pe social media." class="text-white">
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