@extends('master')

@section('title', $user->name.' - Alegeri pentru Consiliul Național al Elevilor')

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
              <div class="col-lg-3 order-lg-2 mb-3">
                <div class="card-profile-image">
                  <a href="#">
                    <img alt="{{ $user->name }}" src="{{ $user->avatarUrl() }}" class="rounded-circle img-thumbnail">
                  </a>
                </div>
              </div>
            </div>
            <div class="text-center mt-5 pt-5 mb-4">
              <h3>
                {{ $user->name }}
              </h3>
              <div class="h6 font-weight-300">
                <i class="mdi mdi-map-marker mr-2"></i>
                @if($user->region && $user->city)
                  {{ $user->city }}, {{ $user->region }} 
                @else
                  Locație necunoscută
                @endif
              </div>
              <div class="h6 font-weight-300">
                <i class="mdi mdi-school mr-2"></i>
                @if($user->institution)
                  {{ $user->institution }}
                @else
                  Nu a menționat un liceu
                @endif
              </div>
              <div>
                <i class="mdi mdi-link-variant mr-2"></i>
                <a href="{{ $user->profileUrl() }}" target=_blank>{{ $user->profileUrl() }}</a>
              </div>
            </div>
          </div>
        </div>
        @if($user->applications->count() == 0)
          <section class="section section-lg" id="section-1">
            <div class="container">
              <div class="card bg-gradient-success shadow-lg border-0">
                <div class="p-5">
                  <div class="row align-items-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                      <h3 class="text-white"><i class="mdi mdi-cancel mr-2"></i> Nu există nicio aplicație depusă. </h3>
                      <p class="lead text-white mt-3">
                        @if(Auth::user() && Auth::user()->is($user))
                          Se pare că nu ai trimis nicio aplicație până acum.
                        @else
                          {{ $user->name ?? 'Utilizatorul ' }} nu a depus nicio aplicație până acum.
                        @endif
                      </p>
                      @if(Auth::user() && Auth::user()->is($user))
                        <a href="{{ route('campaigns') }}" class="btn btn-lg btn-white mt-3"><i class="mdi mdi-share mr-2"></i> Aplică acum</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        @else
          @foreach($user->applications->chunk(4) as $chunk)
            <div class="row mt-3">
              @foreach($chunk as $application)
                <div class="col-sm-12 col-md-6 col-lg-4">
                  <div class="card shadow border-0" id="card-{{ $application->id }}">
                    <img alt="{{ $application->campaign->name }}" src="{{ $application->campaign->imageUrl() }}" class="img-fluid rounded" style="height: 190px; min-height: 190px;">
                    <div class="card-body py-2">
                      <h5 class="text-{{ $application->campaign->color_scheme }} text-uppercase mt-3 float-right">
                        @if($application->isApproved()) <i class="mdi mdi-check text-success" data-toggle="tooltip" data-placement="top" title="Aplicația a fost acceptată."></i> @endif
                        @if($application->isDeclined()) <i class="mdi mdi-cancel text-danger" data-toggle="tooltip" data-placement="top" title="Aplicația a fost respinsă."></i> @endif
                        @if($application->isPending()) <i class="mdi mdi-clock text-primary" data-toggle="tooltip" data-placement="top" title="Aplicația încă așteaptă răspuns."></i> @endif
                      </h5>
                      <h5 class="text-{{ $application->campaign->color_scheme }} text-uppercase mt-3">
                        {{ $application->campaign->name }}
                      </h5>
                      <div class="danger-text">
                        @if($application->campaign->type == 'executive')
                          <i class="mdi mdi-sitemap mr-2"></i> Consiliul Național al Elevilor
                        @endif
                        @if($application->campaign->type == 'regional')
                        <i class="mdi mdi-map-marker-outline mr-2"></i> Consiliul Județean al Elevilor
                        @endif
                        @if($application->campaign->type == 'institutional')
                        <i class="mdi mdi-city-variant-outline mr-2"></i> Consiliul Școlar al Elevilor
                        @endif
                      </div>
                      <small>
                        <i class="mdi mdi-calendar mr-2"></i> Trimisă pe {{ $application->created_at->format('d.m.Y H:i') }}
                      </small>
                      <p class="description">
                        <a href="javascript:{}" onclick="$('#application-{{ $application->id }}-modal').modal('show');" class="btn btn-link text-primary pb-0 pl-0"><i class="mdi mdi-eye mr-2"></i> Citește întrebările</a>
                      </p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endforeach
        @endif
      </div>
    </section>
  </main>

  @foreach($user->applications as $application)
    <div class="modal fade" id="application-{{ $application->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="application-{{ $application->id }}-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="application-{{ $application->id }}-modal">Aplicația #{{ $application->id }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h2 class="lead">
              <i class="mdi mdi-chevron-right"></i>
              Ce te recomandă pentru funcția în cadrul 
              @if($application->campaign->type == 'executive')
                Consiliului Național al Elevilor?
              @endif
              @if($application->campaign->type == 'regional')
                Consiliului Județean {{ Auth::user()->region }}?
              @endif
              @if($application->campaign->type == 'institutional')
                Consiliului Școlar?
              @endif
            </h2>
            <div class="row justify-content-left">
              <div class="col-lg-12">
                <p class="lead ml-md-5 ml-lg-5">
                  {!! nl2br(e($application->question1)) !!}
                </p>
              </div>
            </div>
            <h2 class="lead">
              <i class="mdi mdi-chevron-right"></i>
              Care consideri că este misiunea 
              @if($application->campaign->type == 'executive')
                Consiliului Național al Elevilor?
              @endif
              @if($application->campaign->type == 'regional')
                Consiliului Județean {{ Auth::user()->region }}?
              @endif
              @if($application->campaign->type == 'institutional')
                Consiliului Școlar?
              @endif
            </h2>
            <div class="row justify-content-left">
              <div class="col-lg-12">
                <p class="lead ml-md-5 ml-lg-5">
                  {!! nl2br(e($application->question2)) !!}
                </p>
              </div>
            </div>
            <h2 class="lead">
              <i class="mdi mdi-chevron-right"></i>
              Care a fost cea mai importantă activitate comunitară sau cel mai important proiect în care ai fost implicat(ă)?
            </h2>
            <div class="row justify-content-left">
              <div class="col-lg-12">
                <p class="lead ml-md-5 ml-lg-5">
                  {!! nl2br(e($application->question3)) !!}
                </p>
              </div>
            </div>
            <h2 class="lead">
              <i class="mdi mdi-chevron-right"></i>
              Cum consideri că poți ajuta
              @if($application->campaign->type == 'executive')
                Consiliul Național al Elevilor
              @endif
              @if($application->campaign->type == 'regional')
                Consiliul Județean {{ Auth::user()->region }}
              @endif
              @if($application->campaign->type == 'institutional')
                Consiliul Școlar {{ Auth::user()->region }}
              @endif
              să se dezvolte organizațional prin funcția la care candidezi?
            </h2>
            <div class="row justify-content-left">
              <div class="col-lg-12">
                <p class="lead ml-md-5 ml-lg-5">
                  {!! nl2br(e($application->question4)) !!}
                </p>
              </div>
            </div>
            <h2 class="lead">
              <i class="mdi mdi-chevron-right"></i>
              Descrie succint două dintre cele mai importante demersuri/proiecte pe care le ai în vedere în viitorul mandat.
            </h2>
            <div class="row justify-content-left">
              <div class="col-lg-12">
                <p class="lead ml-md-5 ml-lg-5">
                  {!! nl2br(e($application->question5)) !!}
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="javascript:{}" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-close mr-2"></i> Închide</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      //
    });
  </script>
@endsection

@section('css')

@endsection