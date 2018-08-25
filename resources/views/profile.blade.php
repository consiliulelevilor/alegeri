@extends('master')

@section('title', $user->first_name.' '.$user->last_name)

@section('content')
  <main class="profile-page">
    <section class="masthead section-profile-cover section-shaped my-0" style="background-image: url({{ asset('/images/ag-7.jpg') }});">
      <div class="shape shape-style-1 shape-primary alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{ $user->avatarUrl() }}" class="rounded-circle">
                  </a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading">22</span>
                    <span class="description">Candidaturi</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Întrebări</span>
                  </div>
                  <div>
                    <span class="heading">5</span>
                    <span class="description">răspunsuri</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              <h3>
                {{ $user->first_name }} {{ $user->last_name }}
              </h3>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>Bucharest, Romania</div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer</div>
              <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p>
                    {{ $user->description ?? 'Nu există nicio descriere.' }}  
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      //
    });
  </script>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/themes/default.min.css" type="text/css" media="screen" charset="utf-8">
@endsection