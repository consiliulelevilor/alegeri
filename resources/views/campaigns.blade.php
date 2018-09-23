@extends('master')

@section('title', 'Aplică - Alegeri pentru Consiliul Național al Elevilor')

@section('content')
  <main>
    <div class="position-relative">
      <section class="masthead section section-lg section-shaped pt-5 pb-250" style="background-image: url({{ asset('/images/mastheads/masthead-14.jpg') }}?v={{ cache('v') }});" id="masthead">
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
              <div class="col-lg-6">
                <h1 class="display-3 pt-3 pb-3 text-white">
                  Candidează
                  <span>și fii vocea colegilor tăi!</span>
                </h1>
                <div class="btn-wrapper">
                  <a href="javascript:{}" id="more-button" class="btn btn-success btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="mdi mdi-arrow-right mdi-18px"></i></span>
                    <span class="btn-inner--text">Vezi posturile vacante</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
    </div>
    @if(count($campaigns) == 0)
      <section class="section section-lg" id="section-1">
        <div class="container">
          <div class="card bg-gradient-danger shadow-lg border-0">
            <div class="p-5">
              <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                  <h3 class="text-white"><i class="mdi mdi-emoticon-sad mr-2"></i> Oops, se pare că nu există posturi libere.</h3>
                  <p class="lead text-white mt-3">
                    Facem tot posibilul să ne îmbunătățim echipele din consilii.
                  </p>
                  <p class="lead text-white mt-3">
                    Noi vom anunța oricum pe fiecare candidat în parte, prin Social Media sau e-mail, când vor exista posturi libere. <i class="mdi mdi-heart"></i>
                  </p>
                  <p class="lead text-white mt-3">
                    Poți vedea totuși ce posturi punem la bătaie, pentru a te ajuta să îți găsești drumul pe care vrei să îl parcurgi în Consiliul Național al Elevilor!
                  </p>
                  <a href="javascript:{}" id="details-button" class="btn btn-lg btn-white mt-3"><i class="mdi mdi-arrow-right mr-2"></i> Vezi mai multe</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @else
      <section class="section section-lg pt-lg-0 mt--200" id="section-1">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              @foreach($campaigns->chunk(4) as $chunk)
                <div class="row row-grid">
                  @foreach($chunk as $campaign)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <div class="card card-lift--hover shadow border-0" id="card-{{ $campaign->id }}">
                        @if($campaign->isClosed())
                          <div class="closed overlay">
                            <div class="text text-white">
                              <i class="mdi mdi-cancel mdi-48px"></i>
                            </div>
                          </div>
                        @endif
                        @if(Auth::user()->hasAppliedTo($campaign))
                          <div class="applied overlay">
                            <div class="text text-white">
                              <i class="mdi mdi-check mdi-48px"></i>
                            </div>
                          </div>
                        @endif
                        <img alt="{{ $campaign->name }}" src="{{ $campaign->imageUrl() }}" class="img-fluid rounded" style="height: 150px; min-height: 150px;">
                        <div class="card-body py-2">
                          <h5 class="text-{{ $campaign->color_scheme }} text-uppercase mt-3">{{ $campaign->name }}</h5>
                          <div class="danger-text">
                            @if($campaign->type == 'executive')
                              <i class="mdi mdi-sitemap mr-2"></i> Consiliul Național al Elevilor
                            @endif
                            @if($campaign->type == 'regional')
                            <i class="mdi mdi-map-marker-outline mr-2"></i> Consiliul Județean al Elevilor
                            @endif
                            @if($campaign->type == 'institutional')
                            <i class="mdi mdi-city-variant-outline mr-2"></i> Consiliul Școlar al Elevilor
                            @endif
                          </div>
                          @if($campaign->opened_until)
                            <small>Se închide pe {{ $campaign->opened_until->format('d.m.Y H:i') }}</small>
                          @endif
                          @if($campaign->isOpened())
                          @else
                            <small>Închisă pe {{ $campaign->closed_at->format('d.m.Y H:i') }}</small>
                          @endif
                          @if(Auth::user()->hasAppliedTo($campaign))
                            <a href="javascript:{}" class="btn btn-link text-success mt-0 mb-2"><i class="mdi mdi-check mr-2"></i> Ai aplicat!</a>
                          @else
                            @if($campaign->isOpened())
                              @if(! Auth::user()->canApplyToCampaigns())
                              <a href="{{ route('me') }}?open=profile" class="btn btn-link text-danger mt-3 mb-2"><i class="mdi mdi-arrow-right mr-2"></i> Completează datele</a>
                              @else
                                <a href="javascript:{}" onclick="$('#campaign-{{ $campaign->id }}-modal').modal('show');" class="btn btn-link text-{{ $campaign->color_scheme }} mt-3 mb-2"><i class="mdi mdi-arrow-right mr-2"></i> Aplică</a>
                              @endif
                            @else
                              <a href="javascript:{}" class="btn btn-link text-danger mt-3 mb-2"><i class="mdi mdi-cancel mr-2"></i> Închisă</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>
    @endif
    <section class="section section-lg bg-gradient-success" id="section-3">
      <div class="container">
        <div class="row text-left justify-content-center">
          <div class="col-lg-10">
            <h2 class="display-3 text-white">
              Indiferent dacă ești
              <span>
                la prima sau la ultima candidatură,<br>venim în ajutorul tău!
              </span>
            </h2>
            <p class="lead text-white">
              Consultă ghidul Prima candidatură în Consiliul Elevilor și vei regăsi în el sfaturi utile despre cum să construiești o strategie de dezvoltare și un plan de acțiune
              care să fie relevante, ce trebuie să conțină dosarul tău de candidatură pentru funcțiile din Biroul Executiv, dar și valori/principii esențiale după care să te ghidezi pe
              tot parcursul mandatului tău.
            </p>
          </div>
        </div>
        <div class="row row-grid mt-5">
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-success">
              <i class="mdi mdi-sitemap"></i>
            </div>
            <h5 class="text-white mt-3">Consiliul Național al Elevilor</h5>
            <p class="text-white mt-3">
              Consiliul Național al Elevilor este structura administrativă.
              Este format dintr-un Birou Executiv și un Birou de Presă care coordonează acțiunile.
            </p>
          </div>
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
              <i class="mdi mdi-map-marker-outline"></i>
            </div>
            <h5 class="text-white mt-3">Consiliul Județean al Elevilor</h5>
            <p class="text-white mt-3">
              Consiliul Național al Elevilor este ca un nod central. Din ele, se bifurcă foarte multe consilii județene.
              Aplicațiile se fac per-județ și vor viza strict județul respectiv.
            </p>
          </div>
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-danger">
                <i class="mdi mdi-city-variant-outline"></i>
            </div>
            <h5 class="text-white mt-3">Consiliul Școlar al Elevilor <sup><span class="badge badge-pill badge-primary text-uppercase">În curând</span></sup></h5>
            <p class="text-white mt-3">
              La nivel de instituție există un consiliu ce reprezintă elevii din acea instituție.
            </p>
          </div>
        </div>
      </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
  </main>

  @foreach($campaigns as $campaign)
    @if($campaign->isOpened() && Auth::user()->canApplyToCampaigns())
      <div class="modal fade" id="campaign-{{ $campaign->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="campaign-{{ $campaign->id }}-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="campaign-{{ $campaign->id }}-modal">{{ $campaign->name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('campaign.apply', ['id' => $campaign->id]) }}" id="campaign-{{ $campaign->id }}-form">
                @csrf
                @method('POST')
                <input type="hidden" name="refId" value="{{ $campaign->id }}">
                <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-account-check mr-2"></i> Date personale</div>
                <p>
                  Datele tale personale vor fi preluate automat.
                  Tot ce trebuie să faci este doar să răspunzi la întrebările specifice poziției pentru care aplici.
                </p>
                <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-vote mr-2"></i> Candidatură</div>
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <label>
                      Ce te recomandă pentru funcția în cadrul 
                      @if($campaign->type == 'executive')
                        Consiliului Național al Elevilor?
                      @endif
                      @if($campaign->type == 'regional')
                        Consiliului Județean {{ Auth::user()->region }}?
                      @endif
                      @if($campaign->type == 'institutional')
                        Consiliului Școlar?
                      @endif
                    </label>
                    <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question1">{{ old('question1') }}</textarea>
                  </div>
                  <div class="col-md-12 mb-4">
                    <label>
                      Care consideri că este misiunea 
                      @if($campaign->type == 'executive')
                        Consiliului Național al Elevilor?
                      @endif
                      @if($campaign->type == 'regional')
                        Consiliului Județean {{ Auth::user()->region }}?
                      @endif
                      @if($campaign->type == 'institutional')
                        Consiliului Școlar?
                      @endif
                    </label>
                    <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question2">{{ old('question2') }}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <label>Care a fost cea mai importantă activitate comunitară sau cel mai important proiect în care ai fost implicat(ă)?</label>
                    <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question3">{{ old('question3') }}</textarea>
                  </div>
                  <div class="col-md-12 mb-4">
                    <label>
                      Cum consideri că poți ajuta
                      @if($campaign->type == 'executive')
                        Consiliul Național al Elevilor
                      @endif
                      @if($campaign->type == 'regional')
                        Consiliul Județean {{ Auth::user()->region }}
                      @endif
                      @if($campaign->type == 'institutional')
                        Consiliul Școlar {{ Auth::user()->region }}
                      @endif
                      să se dezvolte organizațional prin funcția la care candidezi?
                    </label>
                    <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question4">{{ old('question4') }}</textarea>
                  </div>
                  <div class="col-md-12 mb-4">
                    <label>
                      Descrie succint două dintre cele mai importante demersuri/proiecte pe care le ai în vedere în viitorul mandat.
                    </label>
                    <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question5">{{ old('question4') }}</textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <a href="javascript:{}" onclick="$(this).html('Așteaptă...'); $('#campaign-{{ $campaign->id }}-form').submit();" class="btn btn-success"><i class="mdi mdi-send mr-2"></i> Trimite</a>
            </div>
          </div>
        </div>
      </div>
    @endif
  @endforeach
@endsection

@section('js')
  <script src="{{ asset('/js/jquery-scrollTo.min.js') }}?v={{ cache('v') }}"></script>

  <script type="text/javascript">
      $(document).ready(function() {
        @if(old('refId'))
          $('#campaign-{{ old('refId') }}-modal').modal('show');
        @endif

        @if(request()->query('jumpTo'))
          $(window).scrollTo($('#card-{{ request()->query('jumpTo') }}'), 1000);
        @endif

        $('#more-button').on('click', function (e) {
          $(window).scrollTo($('#section-1'), 1000);
        });

        $('#details-button').on('click', function (e) {
          $(window).scrollTo($('#section-3'), 1000);
        });
      });
  </script>
@endsection

@section('css')

@endsection