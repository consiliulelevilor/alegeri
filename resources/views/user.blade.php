@extends('master')

@section('title', $user->name.' - Alegeri pentru Consiliul Național al Elevilor')
@section('seo_title', $user->name)
@section('seo_description', $user->description)
@section('seo_image', $user->avatarUrl())

@section('css')
@endsection

@section('prejs')
@endsection

@section('postjs')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#applications-button').on('click', function (e) {
        $(window).scrollTo($('#applications'), 1000);
      });

      @if(Auth::user() && Auth::user()->is($user))
        @if(($errors->any() && old('ref') == 'profile-form') || request()->query('open') == 'profile')
          $('#profile-modal').modal('show');
        @endif

        @if($errors->any() && old('ref') == 'application')
          $('#edit-application-{{ old('refId') }}-modal').modal('show');
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
          $('#city-select').prop('disabled', true);
          $('#city-select').append("<option>Se încarcă orașele...</option>");

          let selectedCity;

          $.get('{{ route('api.regions') }}?onlyRegion=' + $('#region-select').val(), function (cities) {
            @if($user->city)
              selectedCity = '{!! htmlspecialchars_decode($user->city) !!}';
            @endif

            $('#city-select').empty();
            $('#city-select').prop('disabled', false);

            $.each(cities, function (index, item) {
              if (selectedCity && selectedCity == item.name) {
                $('#city-select').append("<option value='" + item.name + "' selected>" + item.name + "</option>");
              } else {
                $('#city-select').append("<option value='" + item.name + "'>" + item.name + "</option>");
              }
            });
          });
        }

        function refreshInstitutions() {
          $('#institution-select').empty();
          $('#institution-select').prop('disabled', true);
          $('#institution-select').append("<option>Se încarcă instituțiile...</option>");

          let selectedInstitution;

          $.get('{{ route('api.institutions') }}?onlyRegion=' + $('#region-select').val(), function (institutions) {
            @if($user->institution)
              selectedInstitution = '{!! htmlspecialchars_decode($user->institution) !!}';
            @endif

            $('#institution-select').empty();
            $('#institution-select').prop('disabled', false);

            $.each(institutions, function (index, item) {
              if (selectedInstitution && selectedInstitution == item) {
                $('#institution-select').append("<option value='" + item + "' selected>" + item + "</option>");
              } else {
                $('#institution-select').append("<option value='" + item + "'>" + item + "</option>");
              }
            });
          });
        }

        $('#upload-profile-picture-anchor').on('click', function (e) {
          $('#profile-picture-input').click();
        });

        $('#upload-cover-picture-anchor').on('click', function (e) {
          $('#cover-picture-input').click();
        });

        $('#profile-picture-input').on('change', function (e) {
          $('#upload-profile-picture').attr('src', '/images/loaders/profile.gif?v={{ cache('v') }}');
          $('#profile-picture-form').submit();
        });

        $('#cover-picture-input').on('change', function (e) {
          // $('#upload-cover-picture').attr('src', '/images/loaders/profile.gif?v={{ cache('v') }}');
          $('#cover-picture-form').submit();
        });
      @endif
    });
  </script>
@endsection

@section('content')
  @if(Auth::user() && Auth::user()->is($user))
    <form method="POST" action="{{ route('me.change.picture') }}" enctype="multipart/form-data" id="profile-picture-form" class="d-none">
      @csrf
      @method('PATCH')
      <input type="hidden" name="ref" value="profile-picture-form">
      <input type="file" id="profile-picture-input" accept=".jpg,.jpeg,.png,.gif" name="profile_picture">
    </form>

    <form method="POST" action="{{ route('me.change.cover') }}" enctype="multipart/form-data" id="cover-picture-form" class="d-none">
      @csrf
      @method('PATCH')
      <input type="hidden" name="ref" value="cover-picture-form">
      <input type="file" id="cover-picture-input" accept=".jpg,.jpeg,.png,.gif" name="cover_picture">
    </form>
  @endif

  <main class="profile-page">
    <section class="masthead section-profile-cover section-shaped my-0" style="background-size: cover; background-image: url({{ $user->coverUrl() }}?v={{ cache('v') }});">
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
                  @if(Auth::user() && Auth::user()->is($user))
                    <a id="upload-profile-picture-anchor" href="javascript:{}">
                      <img data-toggle="tooltip" data-original-title="Fă click pentru a schimba poza!" alt="{{ $user->name }}" src="{{ $user->avatarUrl() }}" class="rounded-circle img-thumbnail" style="z-index: 1;">
                    </a>
                  @else
                    <img alt="{{ $user->name }}" src="{{ $user->avatarUrl() }}" class="rounded-circle img-thumbnail" style="z-index: 1;">
                  @endif
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions pt-sm-5 pt-md-5 pt-lg-0 pb-0 mt-lg-0 text-center">
                  @if(Auth::user() && Auth::user()->is($user))
                    <a href="javascript:{}" data-toggle="modal" data-target="#profile-modal" class="btn btn-sm btn-success float-sm-left float-md-left float-lg-none">Modifică profil</a>
                    <a href="javascript:{}" data-toggle="modal" data-target="#preferences-modal" class="btn btn-sm btn-primary float-sm-left float-md-left float-lg-none">Preferințe</a>
                  @else
                    <a href="javascript:{}" id="applications-button" class="btn btn-sm btn-success float-sm-right float-md-right float-lg-none"><i class="mdi mdi-chart-bubble mr-2"></i> Vezi aplicațiile</a>
                  @endif
                </div>
              </div>
              <div class="col-lg-4 order-lg-1 mt-sm-3">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span title="Numărul de aplicații depuse de către {{ $user->name }}." class="heading text-center btn-link text-success" data-toggle="tooltip" data-placement="bottom">
                      <i class="mdi mdi-chart-bubble mr-1"></i>
                      {{ $user->applications()->count() }}
                    </span>
                  </div>
                  <div>
                    <span title="{{ $user->name }} are o vechime de {{ $user->created_at->diffInDays(now()) }} zile în platformă." class="heading text-center btn-link text-warning" data-toggle="tooltip" data-placement="bottom">
                      <i class="mdi mdi-clock mr-1"></i>
                      {{ $user->created_at->diffInDays(now()) }}
                    </span>
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
              <div class="mt-3">
                @if($user->facebook && $user->facebook->is_public)
                  <a class="text-primary mr-2" href="https://facebook.com/{{ $user->facebook->social_id }}" target=_blank>
                    <i class="mdi mdi-24px mdi-facebook-box"></i>
                  </a>
                @endif
                @if($user->google && $user->google->is_public)
                  <a class="text-danger mr-2" href="https://plus.google.com/{{ $user->google->social_id }}" target=_blank>
                    <i class="mdi mdi-24px mdi-google"></i>
                  </a>
                @endif
                @if($user->instagram && $user->instagram->is_public)
                  <a class="text-dark" href="https://instagram.com/{{ $user->instagram->social_id }}" target=_blank>
                    <i class="mdi mdi-24px mdi-instagram"></i>
                  </a>
                @endif
              </div>
            </div>
            <div class="mt-3 mb-2 py-2 border-top">
              <div class="row justify-content-center">
                <div class="col-lg-12">
                  @if(Auth::user() && Auth::user()->is($user) && ! Auth::user()->accepted_gdpr)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span class="alert-inner--icon"><i class="mdi mdi-sign-caution"></i></span>
                      <span class="alert-inner--text">
                        <strong>Hey!</strong> Nu ești de acord cu politica GDPR. Fără acceptul tău, nu vei putea aplica la niciun post din platformă.
                      </span>
                    </div>
                  @endif
                  <p class="lead ml-md-5 ml-lg-5">
                    @if($user->description)
                      {!! nl2br(e($user->description)) !!}
                    @else
                      Nu există nicio descriere.
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h1 id="applications" class="heading-title mt-5 text-success font-weight-bold"><i class="mdi mdi-chart-bubble mr-2"></i> Aplicațiile depuse</h1>
        @if($user->applications->count() == 0)
          @if(Auth::user() && Auth::user()->is($user) && ! Auth::user()->canApplyToCampaigns())
            <div class="card bg-gradient-danger shadow-lg mt-3 border-0">
              <div class="p-5">
                <div class="row align-items-center">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <h3 class="text-white"><i class="mdi mdi-cancel mr-2"></i> Ești aproape gata... </h3>
                    <p class="lead text-white mt-3 mb-0">
                      Pentru a putea candida, va trebui să îți completezi datele personale, printre care orașul, județul și instituția din care faci parte.
                    </p>
                    <a href="javascript:{}" data-toggle="modal" data-target="#profile-modal" class="btn btn-lg btn-dark mt-4"><i class="mdi mdi-share mr-2"></i> Completează datele</a>
                  </div>
                </div>
              </div>
          @else
            <div class="card bg-gradient-warning shadow-lg mt-3 border-0">
              <div class="p-5">
                <div class="row align-items-center">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <h3 class="text-white"><i class="mdi mdi-cancel mr-2"></i> Nu există nicio aplicație depusă. </h3>
                    <p class="lead text-white mt-3 mb-0">
                      @if(Auth::user() && Auth::user()->is($user))
                        Se pare că nu ai trimis nicio aplicație până acum.
                      @else
                        {{ $user->name ?? 'Utilizatorul ' }} nu a depus nicio aplicație până acum.
                      @endif
                    </p>
                    @if(Auth::user() && Auth::user()->is($user))
                      <a href="{{ route('campaigns') }}" class="btn btn-lg btn-dark mt-4"><i class="mdi mdi-share mr-2"></i> Aplică acum</a>
                    @endif
                  </div>
                </div>
              </div>
            @endif
          </div>
        @endif

        @foreach($user->applications->chunk(4) as $chunk)
          <div class="row mt-3">
            @foreach($chunk as $application)
              <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card shadow border-0" id="card-{{ $application->id }}">
                  @if($application->campaign->imageUrl())
                    <img alt="{{ $application->campaign->name }}" src="{{ $application->campaign->imageUrl() }}" class="img-fluid rounded" style="height: 130px; min-height: 130px;">
                  @endif
                  @if($application->campaign->mdi_icon)
                    <div class="text-center text-{{ $application->campaign->color_scheme }} mt-4"><i class="mdi mdi-{{ $application->campaign->mdi_icon }} mdi-48px"></i></div>
                  @endif
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
                      @if($application->campaign->type == 'executive-scholar')
                        <i class="mdi mdi-hexagon-slice-4 mr-2"></i> Consiliul Școlar al Elevilor
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
                      <a href="javascript:{}" onclick="$('#application-{{ $application->id }}-modal').modal('show');" class="btn btn-link text-primary pb-0 pl-0"><i class="mdi mdi-eye mr-2"></i> Citește răspunsurile</a>
                      @if(Auth::user() && Auth::user()->is($user))
                        @if($application->canBeEdited())
                          <a href="javascript:{}" onclick="$('#edit-application-{{ $application->id }}-modal').modal('show');" class="btn btn-link text-primary pb-0 pl-0">
                            <i class="mdi mdi-pencil text-primary mr-2"></i> Modifică
                          </a>
                        @endif
                      @endif
                    </p>
                  </div>
                </div>
              </div>
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
                      <h2 class="lead font-weight-bold">
                        <i class="mdi mdi-chevron-right"></i>
                        Ce te recomandă pentru funcția în cadrul
                        @if($application->campaign->type == 'executive')
                          Consiliului Național al Elevilor?
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliului Școlar al Elevilor?
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliului Județean al Elevilor {{ Auth::user()->region }}?
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliului Școlar?
                        @endif
                      </h2>
                      <div class="row justify-content-left">
                        <div class="col-lg-12">
                          <p class="lead ml-md-5 ml-lg-5">
                            <i>{!! nl2br(e($application->question1)) !!}</i>
                          </p>
                        </div>
                      </div>
                      <h2 class="lead font-weight-bold">
                        <i class="mdi mdi-chevron-right"></i>
                        Care consideri că este misiunea
                        @if($application->campaign->type == 'executive')
                          Consiliului Național al Elevilor?
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliului Școlar al Elevilor?
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliului Județean al Elevilor {{ Auth::user()->region }}?
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliului Școlar?
                        @endif
                      </h2>
                      <div class="row justify-content-left">
                        <div class="col-lg-12">
                          <p class="lead ml-md-5 ml-lg-5">
                            <i>{!! nl2br(e($application->question2)) !!}</i>
                          </p>
                        </div>
                      </div>
                      <h2 class="lead font-weight-bold">
                        <i class="mdi mdi-chevron-right"></i>
                        Care a fost cea mai importantă activitate comunitară sau cel mai important proiect în care ai fost implicat(ă)?
                      </h2>
                      <div class="row justify-content-left">
                        <div class="col-lg-12">
                          <p class="lead ml-md-5 ml-lg-5">
                            <i>{!! nl2br(e($application->question3)) !!}</i>
                          </p>
                        </div>
                      </div>
                      <h2 class="lead font-weight-bold">
                        <i class="mdi mdi-chevron-right"></i>
                        Cum consideri că poți ajuta
                        @if($application->campaign->type == 'executive')
                          Consiliul Național al Elevilor
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliul Școlar al Elevilor
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliul Județean al Elevilor {{ Auth::user()->region }}
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliul Școlar al Elevilor {{ Auth::user()->region }}
                        @endif
                        să se dezvolte organizațional prin funcția la care candidezi?
                      </h2>
                      <div class="row justify-content-left">
                        <div class="col-lg-12">
                          <p class="lead ml-md-5 ml-lg-5">
                            <i>{!! nl2br(e($application->question4)) !!}</i>
                          </p>
                        </div>
                      </div>
                      <h2 class="lead font-weight-bold">
                        <i class="mdi mdi-chevron-right"></i>
                        Descrie succint două dintre cele mai importante demersuri/proiecte pe care le ai în vedere în viitorul mandat.
                      </h2>
                      <div class="row justify-content-left">
                        <div class="col-lg-12">
                          <p class="lead ml-md-5 ml-lg-5">
                            <i>{!! nl2br(e($application->question5)) !!}</i>
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
          </div>
        @endforeach
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
            <form method="POST" action="" id="profile-form">
              @csrf
              @method('PATCH')
              <input type="hidden" name="ref" value="profile-form">
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
                    <label>Care este numărul tău de telefon?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="0712345678" value="{{ old('phone') ?? $user->phone }}" name="phone" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>În ce județ locuiești? *</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                      </div>
                      <select class="form-control form-control-alternative" name="region" id="region-select">
                        @foreach(json_decode(cache('json:regions')) as $region => $cities)
                          <option value="{{ $region }}" @if($region == $user->region) selected @endif>{{ $region }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
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
                    <label>Ce liceu frecventezi? *</label>
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
                    <label>În ce clasă ești?</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-school"></i></span>
                      </div>
                      <select class="form-control form-control-alternative" name="class">
                        <option value="IX" @if(old('class') == 'IX' || $user->class == 'IX') selected @endif>Clasa a IXa</option>
                        <option value="X" @if(old('class') == 'X' || $user->class == 'X') selected @endif>Clasa a Xa</option>
                        <option value="XI" @if(old('class') == 'XI' || $user->class == 'XI') selected @endif>Clasa a XIa</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-comment-account mr-2"></i> Despre persoana ta</div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label>Scrie-ne câteva lucruri despre tine. Descrierea va fi făcută publică pe profilul tău.</label>
                  <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="description">{{ old('description') ?? $user->description }}</textarea>
                </div>
              </div>
              <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-lock mr-2"></i> Securitate & Confidențialitate</div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <p>
                    Consiliul Național al Elevilor se angajează să nu ofere niciunei terțe persoane acces la date confidențiale aferente celor care se înregistrează
                    pe această platformă. Totodată, CNE va păstra datele pe unități de stocare personale, în medii securizate,
                    și va folosi informațiile în cauză doar pentru a eficientiza strângerea unei baze de date cu toți elevii reprezentanți
                    din România, pentru a atesta că aparțin unei persoane reale, pentru a contacta membrii platformei, dacă este nevoie.
                    De altfel, aceștia pot cere ca datele lor personale să fie șterse; cererile pot fi trimise la adresa de mail <a href="mailto:cne.secretariat@gmail.com">cne.secretariat@gmail.com</a>
                  </p>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="accepted_gdpr" id="accepted-gdpr" type="checkbox" @if($user->accepted_gdpr) checked @endif>
                    <label class="custom-control-label" for="accepted-gdpr">
                      DA, sunt de acord cu procesarea datelor mele personale.
                    </label>
                  </div>
                </div>
              </div>
              <div class="lead mb-2 mt-0 pt-0"><i class="mdi mdi-link-variant mr-2"></i> Setează URL-ul profilului</div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>{{ config('app.url') }}/</label>
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                      </div>
                      <input class="form-control form-control-alternative" placeholder="popescu-ion" value="{{ old('profile_name') ?? $user->profile_name }}" name="profile_name" type="text">
                    </div>
                  </div>
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
              <input type="hidden" name="ref" value="preferences-form">
              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="lead mb-2 mt-sm-3 pt-0"><i class="mdi mdi-twitter mr-2"></i> Preferințe Social Media</div>
                  @if($user->facebook)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_facebook_public" id="make-facebook-public-check" type="checkbox" @if($user->facebook->is_public) checked @endif>
                      <label class="custom-control-label" for="make-facebook-public-check">
                        Doresc ca profilul meu de <i class="mdi mdi-facebook-box ml-0"></i> Facebook să fie făcut public.
                      </label>
                    </div>
                  @endif

                  @if($user->google)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_google_public" id="make-google-public-check" type="checkbox" @if($user->google->is_public) checked @endif>
                      <label class="custom-control-label" for="make-google-public-check">
                        Doresc ca profilul meu de <i class="mdi mdi-google ml-0"></i> Google să fie făcut public.
                      </label>
                    </div>
                  @endif

                  @if($user->instagram)
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="make_instagram_public" id="make-instagram-public-check" type="checkbox" @if($user->instagram->is_public) checked @endif>
                      <label class="custom-control-label" for="make-instagram-public-check">
                        Doresc ca profilul meu de <i class="mdi mdi-instagram ml-0"></i> Instagram să fie făcut public.
                      </label>
                    </div>
                  @endif
                </div>
                <div class="col-md-6">
                  <div class="lead mb-2 mt-sm-3 pt-0"><i class="mdi mdi-email mr-2"></i> Newsletter</div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="is_mail_subscribed" id="newsletter-check" type="checkbox" @if($user->is_mail_subscribed) checked @endif>
                    <label class="custom-control-label" for="newsletter-check">
                      Da, vreau să mă abonez la newsletter pentru a primi informații despre Consiliul Elevilor.
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="lead mb-0 mt-0"><i class="mdi mdi-google mr-2"></i> Conturile mele</div>
                    <div class="pb-1 pt-1">
                      @if($user->facebook)
                        <i class="mdi mdi-facebook-box mr-1"></i> Conectat ca și <a href="https://facebook.com/{{ $user->facebook->social_id }}" target=_blank>{{ $user->facebook->name }}</a>
                        (<a href="{{ route('social.unlink', ['social' => 'facebook']) }}">Deconectare</a>)
                      @else
                        <i class="mdi mdi-facebook-box mr-1"></i> <a href="{{ route('social', ['social' => 'facebook']) }}?link=1">Conectează un cont de Facebook</a>
                      @endif
                    </div>
                    <div class="pb-1 pt-1">
                      @if($user->google)
                        <i class="mdi mdi-google mr-1"></i> Conectat ca și <a href="https://plus.google.com/{{ $user->google->social_id }}" target=_blank>{{ $user->google->name }}</a>
                        (<a href="{{ route('social.unlink', ['social' => 'google']) }}">Deconectare</a>)
                      @else
                      <i class="mdi mdi-google mr-1"></i> <a href="{{ route('social', ['social' => 'google']) }}?link=1">Conectează un cont de Google</a>
                      @endif
                    </div>
                    <div class="pb-1 pt-1">
                      @if($user->instagram)
                        <i class="mdi mdi-instagram mr-1"></i> Conectat ca și <a href="https://instagram.com/{{ $user->instagram->social_id }}" target=_blank>{{ $user->instagram->name }}</a>
                        (<a href="{{ route('social.unlink', ['social' => 'instagram']) }}">Deconectare</a>)
                      @else
                      <i class="mdi mdi-instagram mr-1"></i> <a href="{{ route('social', ['social' => 'instagram']) }}?link=1">Conectează un cont de Instagram</a>
                      @endif
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

    @foreach($user->applications as $application)
      @if($application->canBeEdited())
        <div class="modal fade" id="edit-application-{{ $application->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="edit-application-{{ $application->id }}-modal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="edit-application-{{ $application->id }}-title">Modifică aplicația ta #{{ $application->id }} ({{ $application->campaign->name }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('me.edit.application', ['id' => $application->id]) }}" id="application-{{ $application->id }}-form">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="ref" value="application">
                  <input type="hidden" name="refId" value="{{ $application->id }}">
                  <div class="lead mb-2 mt-2 pt-0"><i class="mdi mdi-vote mr-2"></i> Candidatură</div>
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <label>
                        Ce te recomandă pentru funcția în cadrul
                        @if($application->campaign->type == 'executive')
                          Consiliului Național al Elevilor?
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliului Școlar al Elevilor?
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliului Județean al Elevilor {{ Auth::user()->region }}?
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliului Școlar?
                        @endif
                      </label>
                      <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question1">{{ old('question1') ?? $application->question1 }}</textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                      <label>
                        Care consideri că este misiunea
                        @if($application->campaign->type == 'executive')
                          Consiliului Național al Elevilor?
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliului Școlar al Elevilor?
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliului Județean al Elevilor {{ Auth::user()->region }}?
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliului Școlar?
                        @endif
                      </label>
                      <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question2">{{ old('question2') ?? $application->question2 }}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <label>Care a fost cea mai importantă activitate comunitară sau cel mai important proiect în care ai fost implicat(ă)?</label>
                      <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question3">{{ old('question3') ?? $application->question3 }}</textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                      <label>
                        Cum consideri că poți ajuta
                        @if($application->campaign->type == 'executive')
                          Consiliul Național al Elevilor
                        @endif
                        @if($application->campaign->type == 'executive-scholar')
                          Consiliul Școlar al Elevilor
                        @endif
                        @if($application->campaign->type == 'regional')
                          Consiliul Județean al Elevilor {{ Auth::user()->region }}
                        @endif
                        @if($application->campaign->type == 'institutional')
                          Consiliul Școlar al Elevilor {{ Auth::user()->region }}
                        @endif
                        să se dezvolte organizațional prin funcția la care candidezi?
                      </label>
                      <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question4">{{ old('question4') ?? $application->question4 }}</textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                      <label>
                        Descrie succint două dintre cele mai importante demersuri/proiecte pe care le ai în vedere în viitorul mandat.
                      </label>
                      <textarea class="form-control form-control-alternative" rows="5" placeholder="Scrie aici..." name="question5">{{ old('question5') ?? $application->question5 }}</textarea>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <a href="javascript:{}" onclick="$(this).html('Așteaptă...'); $('#application-{{ $application->id }}-form').submit();" class="btn btn-primary"><i class="mdi mdi-pencil mr-2"></i> Modifică</a>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  @endif
@endsection
