@extends('master')

@section('title', 'Alegeri CNE')

@section('content')
    
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui masthead image" style="background-image: url({{ asset('/images/ag-2.jpg') }});"></div>
        <div class="ui container">
            <div class="ui large secondary inverted pointing home menu">
                <a class="toc item">
                    <i class="mdi mdi-menu"></i>
                </a>
                <div class="item">
                    <img src="{{ asset('/images/logo-white.png') }}">
                </div>
                <div class="item">
                    <a href="{{ route('users') }}" class="ui inverted secondary button"><i class="fa fa-users"></i> &nbsp; Candidați</a>
                </div>

                <div class="right item">
                    @auth
                        <img src="{{ Auth::user()->avatarUrl() }}">
                        &nbsp;
                        <a href="{{ route('user.profile', ['idOrSlug' => Auth::user()->id]) }}" class="ui inverted secondary icon button"><i class="fa fa-user"></i> &nbsp; Profilul meu</a>
                        <a href="{{ route('logout') }}" class="ui inverted secondary icon button"><i class="mdi mdi-power"></i></a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="ui inverted secondary button"><i class="fa fa-user-tie"></i> &nbsp; Zona candidaților</a>
                    @endguest
                </div>
            </div>
        </div>
        @auth
            <div class="ui text container">
                <h1 class="ui inverted header green-text">
                    Susține elevii.
                </h1>
            </div>
        @endauth

        @guest
            <div class="ui text container">
                <h1 class="ui inverted header green-text">
                    Fă parte din Consiliul Național al Elevilor.
                </h1>
                <br>
                <a href="{{ route('login') }}?new=1" class="ui big blue circular button">Înscrie-te &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
        @endguest
    </div>

    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui vertical stripe segment">
                <div class="ui four statistics">
                    <div class="statistic">
                        <div class="value">22</div>
                        <div class="label">
                            candidaturi depuse
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">22</div>
                        <div class="label">
                            județe au aplicat
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">300+</div>
                        <div class="label">
                            întrebări puse candidaților
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">30+</div>
                        <div class="label">
                            membri în CNE
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui vertical stripe segment">
                <div class="ui middle aligned stackable grid container">
                    <div class="row">
                        <div class="eight wide column">
                            <h3 class="ui header"><i class="fa fa-users"></i> &nbsp; Cine suntem?</h3>
                            <p>Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.</p>
                            <h3 class="ui header"><i class="fa fa-user-check"></i> &nbsp; De ce să ni te alături?</h3>
                            <p>We can give your company superpowers to do things that they never thought possible. Let us delight your customers and empower your needs...through pure data analytics.</p>
                            <h3 class="ui header"><i class="fa fa-band-aid"></i> &nbsp; Ce beneficii ai?</h3>
                            <p>Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.</p>
                            
                        </div>
                        <div class="six wide right floated column">
                            <img src="{{ asset('/images/ag-5.jpg') }}" class="ui large bordered rounded image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.masthead').visibility({
                once: false,
                onBottomPassed: function() {
                    $('.fixed.menu').transition('fade in');
                },
                onBottomPassedReverse: function() {
                    $('.fixed.menu').transition('fade out');
                }
            });
        });
    </script>
@endsection

@section('css')

@endsection