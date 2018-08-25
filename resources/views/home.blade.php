@extends('master')

@section('title', 'Alegeri CNE')

@section('content')
    
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui masthead image" style="background-image: url({{ asset('/images/ag-8.jpg') }});"></div>
        <div class="ui container">
            <div class="ui large secondary inverted pointing home menu">
                <a class="toc item">
                    <i class="mdi mdi-menu mdi-36px"></i>
                </a>
                <div class="item logo">
                    <img src="{{ asset('/images/logo/logo-1024-white.png') }}">
                </div>

                <div class="right item">
                    @auth
                        <img src="{{ Auth::user()->avatarUrl() }}">
                        &nbsp;
                        <a href="{{ route('me') }}" class="ui inverted icon button"><i class="fa fa-user"></i> &nbsp; Profilul meu</a>
                        <a href="{{ route('logout') }}" class="ui inverted icon button"><i class="mdi mdi-power"></i></a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="ui inverted button"><i class="fa fa-user-tie"></i> &nbsp; Zona candidaților</a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="ui text container">
            <h1 class="ui inverted header white-text">
                <u>Fă parte din Consiliul Național al Elevilor.</u>
            </h1>
            <br>
            <a href="javascript:{}" onclick="$.scrollTo('#details', { duration: 1000 });" class="ui big green circular button">
                Descoperă mai multe &nbsp; <i class="fa fa-arrow-right"></i>
            </a>
        </div>
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
            <div class="ui vertical stripe segment" id="details">
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

    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui vertical stripe segment">
                <div class="ui stackable grid container">
                    <div class="row">
                        @for($i = 0; $i < 4; $i++)
                            <div class="column four wide computer eight wide tablet sixteen wide mobile">
                                <img src="{{ asset('images/profile/patrick.png') }}" class="ui circular tiny image">
                                <h2 class="ui header">
                                    Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.
                                </h2>
                                <i>&mdash; John Doe, Procuror DNA</i>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="ui inverted vertical masthead center aligned segment">
            <div class="ui masthead image" style="background-image: url({{ asset('/images/ag-6.jpg') }});"></div>
            <div class="ui text container">
                <h1 class="ui inverted header white-text">
                    <u>Înscrie-te și poți candida la orice structură.</u>
                </h1>
                <br>
                <a href="{{ route('login') }}?new=true" id="to-login-button" class="ui big green circular button">
                    Către înscrieri &nbsp; <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    @endguest
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

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

            $('#to-login-button').on('click', function(e) {
                $(this).toggleClass('loading disabled');
            });
        });
    </script>
@endsection

@section('css')

@endsection