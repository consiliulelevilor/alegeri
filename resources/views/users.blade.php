@extends('master')

@section('title', 'Candidați - Alegeri pentru Consiliul Național al Elevilor')

@section('css')
@endsection

@section('prejs')
@endsection

@section('postjs')
  <script type="text/javascript">
    $(document).ready(function () {
      //
    });
  </script>
@endsection

@section('content')
  <main>
    <div class="position-relative">
      <section id="masthead" class="masthead section section-lg section-shaped pb-250" style="background-image: url('/images/mastheads/masthead-19.jpg?v={{ cache('v') }}');">
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
          <div class="col px-0">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 offset-lg-3 offset-md-2 text-center">
                <h1 class="display-3 text-white">
                  Îți poți căuta reprezentanții aici!
                </h1>
                <form method="GET" action="">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                      </div>
                      <input type="text" name="query" class="form-control" placeholder="Introdu cuvinte cheie..." @if(request()->query('query')) value="{{ rawurldecode(request()->query('query')) }}" @endif>
                    </div>
                  </div>
                  <div class="mb-4">
                    <img src="/images/algolia-dark.png" />
                  </div>
                  <div class="btn-wrapper">
                    <button onclick="$(this).html('Așteaptă...');" class="btn btn-success btn-icon mb-3 mb-sm-0">
                      <span class="btn-inner--text">Caută printre candidați <i class="mdi mdi-arrow-right ml-2"></i></span>
                    </button>
                  </div>
                </form>
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
      <section class="section section-lg pt-lg-0 mt--200">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              @foreach($users->chunk(3) as $usersChunk)
                <div class="row row-grid">
                  @foreach($usersChunk as $user)
                    <div class="col-lg-4">
                      <div class="card card-lift--hover shadow border-0">
                        <div class="card-body py-5">
                          <img class="icon img fluid rounded-circle mb-2" src="{{ $user->avatarUrl() }}" />
                          <h6 class="text-primary text-uppercase">{{ $user->name }}</h6>
                          <p class="description mt-3">
                            {{ $user->description }}
                          </p>
                          <div>
                            <i class="mdi mdi-school mr-2"></i>
                            @if($user->institution)
                              {{ $user->institution }}
                            @else
                              Nu a menționat un liceu
                            @endif
                          </div>
                          <div>
                            <i class="mdi mdi-map-marker mr-2"></i>
                            @if($user->region && $user->city)
                              {{ $user->city }}, {{ $user->region }}
                            @else
                              Locație necunoscută
                            @endif
                          </div>
                          <a href="{{ $user->profileUrl() }}" class="btn btn-sm btn-primary mt-4">Către candidat <i class="mdi mdi-arrow-right ml-2"></i></a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
            <div class="mt-5 mb-0">
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection