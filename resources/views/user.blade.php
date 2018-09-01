@extends('master')

@section('title', $user->name)

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
                    <img src="{{ $user->avatarUrl() }}" class="rounded-circle img-thumbnail">
                  </a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions pt-sm-5 pt-md-5 pt-lg-0 pb-0 mt-lg-0 text-center">
                  @if(Auth::user() && Auth::user()->is($user))
                    <a href="javascript:{}" data-toggle="modal" data-target="#profile-modal" class="btn btn-sm btn-success">Modifică</a>
                    <a href="javascript:{}" data-toggle="modal" data-target="#preferences-modal" class="btn btn-sm btn-primary">Preferințe</a> 
                  @else
                    <a href="javascript:{}" data-toggle="modal" data-target="#question-modal" class="btn btn-sm btn-info float-sm-left float-md-left float-lg-none"><i class="mdi mdi-help mr-2"></i> Întreabă</a>
                    <a href="javascript:{}" class="btn btn-sm btn-primary float-sm-right float-md-right float-lg-none"><i class="mdi mdi-email"></i> Contact</a>
                  @endif
                </div>
              </div>
              <div class="col-lg-4 order-lg-1 mt-sm-3">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading">{{ $user->applications()->count() }}</span>
                    <span class="description">Candidaturi</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Întrebări</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Stele</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
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
            <div class="mt-5 py-2 border-top text-left">
              <h2 class="lead">
                <i class="mdi mdi-chevron-right"></i>
                Ce te recomandă pentru funcția în cadrul Consiliului Școlar/Județean/Național al Elevilor pentru candidezi?
              </h2>
              <div class="row justify-content-left">
                <div class="col-lg-12">
                  <p class="lead ml-md-5 ml-lg-5">
                    @if($user->question1)
                      {!! nl2br(e($user->question1)) !!}
                    @else
                      Nu există răspuns.
                    @endif
                  </p>
                </div>
              </div>
              <h2 class="lead">
                <i class="mdi mdi-chevron-right"></i>
                Care consideri că este misiunea Consiliului Școlar/Județean/Național al Elevilor pentru care candidezi?
              </h2>
              <div class="row justify-content-left">
                <div class="col-lg-12">
                  <p class="lead ml-md-5 ml-lg-5">
                    @if($user->question2)
                      {!! nl2br(e($user->question2)) !!}
                    @else
                      Nu există răspuns.
                    @endif
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
                    @if($user->question3)
                      {!! nl2br(e($user->question4)) !!}
                    @else
                      Nu există răspuns.
                    @endif
                  </p>
                </div>
              </div>
              <h2 class="lead">
                <i class="mdi mdi-chevron-right"></i>
                Cum consideri că poți ajuta Consiliul Școlar/Județean/Național al Elevilor să se dezvolte organizațional prin funcția la care candidezi?
              </h2>
              <div class="row justify-content-left pb-4">
                <div class="col-lg-12">
                  <p class="lead ml-md-5 ml-lg-5">
                    @if($user->question4)
                      {!! nl2br(e($user->question4)) !!}
                    @else
                      Nu există răspuns.
                    @endif
                  </p>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  @if(Auth::user() && Auth::user()->is($user))
    <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="profile-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="profile-modal">Modifică profilul</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if($errors->any())
              <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> {{ $errors->first() }}
              </div>
            @endif
            <form method="POST" action="" id="profile-form">
              @csrf
              @method('PATCH')
              <div class="lead mb-2 mt-0 pt-0"><i class="mdi mdi-account mr-2"></i> Informații personale</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cum te cheamă?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="Ion Popescu" value="{{ old('name') ?? $user->name }}" name="name" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ce adresă de E-Mail ai?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="ion.popescu@yahoo.com" value="{{ old('email') ?? $user->email }}" name="email" type="text">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>În ce județ locuiești?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                      </div>
                      <select class="form-control form-control-alternative" name="region" id="region-select">
                        @foreach(json_decode(file_get_contents(public_path('/json/regions.json'))) as $region => $cities)
                          <option value="{{ $region }}" @if($region == $user->region) selected @endif>{{ $region }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>În ce oraș locuiești?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-domain"></i></span>
                      </div>
                      <select class="form-control form-control-alternative" name="city" id="city-select" disabled>
                        @if(! $user->region)
                          <option value="">Alege un județ mai întâi...</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-chair-school mr-2"></i> Învățământ</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ce liceu frecventezi?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-school"></i></span>
                      </div>
                      <select class="form-control form-control-alternative" name="institution" id="institution-select" disabled>
                        @if(! $user->institution)
                          <option value="">Alege un județ mai întâi...</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>În ce an ai început cursurile la liceu?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="2016" value="{{ old('starting_year') ?? $user->starting_year }}" name="starting_year" type="text">
                    </div>
                  </div>
                </div>
              </div>
              <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-vote mr-2"></i> Candidatură</div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label>Ce te recomandă pentru funcția în cadrul Consiliului Școlar/Județean/Național al Elevilor pentruj candidezi?</label>
                  <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question1">{{ old('question1') ?? $user->question1 }}</textarea>
                </div>
                <div class="col-md-12 mb-4">
                  <label>Care consideri că este misiunea Consiliului Școlar/Județean/Național al Elevilor pentru care candidezi?</label>
                  <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question2">{{ old('question2') ?? $user->question2 }}</textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label>Care a fost cea mai importantă activitate comunitară sau cel mai important proiect în care ai fost implicat(ă)?</label>
                  <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question3">{{ old('question3') ?? $user->question3 }}</textarea>
                </div>
                <div class="col-md-12">
                  <label>Cum consideri că poți ajuta Consiliul Școlar/Județean/Național al Elevilor să se dezvolte organizațional prin funcția la care candidezi?</label>
                  <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question4">{{ old('question4') ?? $user->question4 }}</textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript:{}" onclick="$(this).html('Așteaptă...'); $('#profile-form').submit();" class="btn btn-success"><i class="mdi mdi-check mr-2"></i> Salvează</a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="preferences-modal" tabindex="-1" role="dialog" aria-labelledby="preferences-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="profile-modal">Preferințe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="" id="preferences-form">
              @csrf
              @method('PATCH')
              <div class="row">
                <div class="col-md-6">
                  <div class="lead mb-2 mt-0 pt-0"><i class="mdi mdi-link-variant mr-2"></i> Setează URL-ul profilului</div>
                  <div class="form-group">
                    <label>{{ env('APP_URL') }}/</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="popescu-ion" value="{{ old('profile_name') ?? $user->profile_name }}" name="profile_name" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="lead mb-2 mt-0 pt-0"><i class="mdi mdi-twitter mr-2"></i> Preferințe Social Media</div>
                  @if($user->facebook)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_facebook_public" id="make-facebook-public-check" type="checkbox" @if($user->facebook->is_public) checked @endif>
                      <label class="custom-control-label" for="make-facebook-public-check">
                        Doresc ca profilul meu de Facebook să fie făcut public.
                      </label>
                    </div>
                  @endif

                  @if($user->google)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_google_public" id="make-google-public-check" type="checkbox" @if($user->google->is_public) checked @endif>
                      <label class="custom-control-label" for="make-google-public-check">
                        Doresc ca profilul meu de Google să fie făcut public.
                      </label>
                    </div>
                  @endif

                  @if($user->instagram)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_instagram_public" id="make-instagram-public-check" type="checkbox" @if($user->instagram->is_public) checked @endif>
                      <label class="custom-control-label" for="make-instagram-public-check">
                        Doresc ca profilul meu de Instagram să fie făcut public.
                      </label>
                    </div>
                  @endif
                </div>
              </div>
              <div class="lead mb-2 mt-2"><i class="mdi mdi-email mr-2"></i> Metode de contact</div>
              <div class="row">
                <div class="col-md-12">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="is_mail_subscribed" id="newsletter-check" type="checkbox" @if($user->is_mail_subscribed) checked @endif>
                    <label class="custom-control-label" for="newsletter-check">
                      Da, vreau să mă abonez la newsletter pentru a primi informații despre consilii. (Newsletter-ul este săptămânal)
                    </label>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript:{}" onclick="$(this).html('Așteaptă...'); $('#preferences-form').submit();" class="btn btn-success"><i class="mdi mdi-check mr-2"></i> Salvează</a>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      @if(Auth::user() && Auth::user()->is($user))
        @if($errors->any())
          $('#profile-modal').modal('show');
        @endif

        @if(! $user->region)
          $('#city-select').prop('disabled', false);
          $('#institution-select').prop('disabled', false);
        @else
          refreshCities();
          refreshInstitutions();
        @endif

        $('#region-select').on('change', function (e) {
          refreshCities();
          refreshInstitutions();
        });

        function refreshCities() {
          $('#city-select').empty();
          $('#city-select').prop('disabled', false);
          let selectedCity;
          $.get('{{ asset('json/regions.json') }}', function (data) {
            let cities = data[$('#region-select').val()];

            @if($user->city)
              selectedCity = '{{ $user->city }}';
            @endif

            $.each(cities, function (index, item) {
              if (selectedCity && selectedCity == item) {
                $('#city-select').append('<option value="' + item + '" selected>' + item + '</option>');
              } else {
                $('#city-select').append('<option value="' + item + '">' + item + '</option>');
              }
            });
          });
        }

        function refreshInstitutions() {
          $('#institution-select').empty();
          $('#institution-select').prop('disabled', false);
          let selectedInstitution;
          let institutionClient = new XMLHttpRequest();
          $.get('{{ asset('json/institutions.json') }}', function (data) {
            let institutions = data[$('#region-select').val()];

            @if($user->institution)
              selectedInstitution = '{{ $user->institution }}';
            @endif

            $.each(institutions, function (index, item) {
              if (selectedInstitution && selectedInstitution == item) {
                $('#institution-select').append('<option value="' + item + '" selected>' + item + '</option>');
              } else {
                $('#institution-select').append('<option value="' + item + '">' + item + '</option>');
              }
            });
          });
        }
      @endif
    });
  </script>
@endsection

@section('css')

@endsection