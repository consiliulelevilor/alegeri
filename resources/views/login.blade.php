@extends('master')

@section('title', 'Alegeri CNE')

@section('content')
    <div class="ui login image" style="background-image: url({{ asset('/images/ag-10.jpg') }});"></div>
    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui middle aligned center aligned login grid">
                <div class="column six wide computer twelve wide tablet sixteen wide mobile">
                    <div class="ui raised padded segment">
                        <h2 class="ui center aligned icon header">
                            <img src="{{ asset('/images/logo/logo-1024-black.png') }}">
                            <br><br>
                            <div class="content">
                                @if(request()->query('new'))
                                    Creează un profil de candidat
                                @else
                                    Intră în zona candidaților
                                @endif
                            </div>
                        </h2>

                        @if(request()->query('new'))
                            <p>
                                Creeză rapid un profil de candidat
                                <br>
                                folosind Facebook, Google sau Instagram.
                            </p>
                        @endif
                        <br>

                        <div class="ui centered grid">
                            <a href="{{ route('social.login', ['social' => 'facebook']) }}" class="ui big facebook icon button">
                                <i class="mdi mdi-facebook-box"></i>
                            </a>
                            <a href="{{ route('social.login', ['social' => 'google']) }}" class="ui big google plus icon button">
                                <i class="mdi mdi-google"></i>
                            </a>
                            <a href="{{ route('social.login', ['social' => 'instagram']) }}" class="ui big instagram icon button">
                                <i class="mdi mdi-instagram"></i>
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('a.button').on('click', function(e) {
                $(this).toggleClass('loading');
                $('a.ui.button :not(.loading)').each(function(index, button) {
                    if($(this).is($(button))) {
                        $(button).parent().toggleClass('disabled');
                    }
                });
            });
        });
    </script>
@endsection

@section('css')

@endsection