@extends('master')

@section('title', $user->first_name.' '.$user->last_name)

@section('content')
    <div class="ui profile image" style="background-image: url({{ asset('/images/patterns/school.png') }}); background-size: auto !important; background-repeat: repeat !important;"></div>
    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui middle aligned center aligned profile grid">
                <div class="column six wide computer twelve wide tablet sixteen wide mobile">
                    <div class="ui raised padded segment">
                        <div class="ui inverted dimmer" id="profile-loader">
                          <div class="ui loader"></div>
                        </div>
                        <img src="{{ $user->avatarUrl() }}" class="ui circular centered small image">
                        <h2 class="ui center aligned icon header">
                            <div class="content" id="name">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </div>
                        </h2>
                        <p align="left" id="description" class="ui grey-text">
                            {{ $user->description }}
                        </p>
                    </div>
                    <div class="ui raised padded segment">
                        <div class="ui inverted dimmer" id="profile-loader">
                          <div class="ui loader"></div>
                        </div>
                        <h2 class="ui center aligned icon header">
                            <i class="mdi mdi-map-marker"></i>
                            <div class="content">
                                În ce județ stai?
                            </div>
                        </h2>
                        <select class="ui dropdown fluid">
                            <option value="">Gender</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>
                    <div class="ui raised padded segment">
                        <div class="ui inverted dimmer" id="profile-loader">
                          <div class="ui loader"></div>
                        </div>
                        <h2 class="ui center aligned icon header">
                            <i class="mdi mdi-domain"></i>
                            <div class="content">
                                Ce liceu frecventezi?
                            </div>
                        </h2>
                        <select class="ui dropdown fluid">
                            <option>Alege județul mai întâi...</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            @if($user->canBeEdited())
                let typingTimer;
                let typingInterval = 2000;

                new MediumEditor('#name', {placeholder: {text: 'Cum te cheamă?', hideOnClick: false}});
                new MediumEditor('#description', {placeholder: {text: 'Ce ne poți spune despre tine?', hideOnClick: false}});

                $('#name').on('keyup', function(e) {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(saveData, typingInterval);
                });

                $('#name').on('keyDown', function(e) {
                    clearTimeout(typingTimer);
                });

                function saveData() {
                    $('div[id=profile-loader]').toggleClass('active');
                    
                    let name = $('#name').text().trim();
                    let description = $('#description').text().trim();

                    console.log(name, description);
                    $('div[id=profile-loader]').toggleClass('active');
                }
            @endif

        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/themes/default.min.css" type="text/css" media="screen" charset="utf-8">
@endsection