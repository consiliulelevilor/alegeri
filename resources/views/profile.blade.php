@extends('master')

@section('title', $user->first_name.' '.$user->last_name)

@section('content')
    <div class="ui profile image" style="background-image: url({{ asset('/images/patterns/school.png') }}); background-size: auto !important; background-repeat: repeat !important;"></div>
    <div class="ui centered grid">
        <div class="fifteen wide column">
            <div class="ui profile grid">
                <div class="column five wide computer eight wide tablet sixteen wide mobile">
                    <div class="ui raised padded @if(!$user->description || !$user->first_name || !$user->last_name) red @endif segment">
                        <div class="ui inverted dimmer" id="profile-loader">
                          <div class="ui loader"></div>
                        </div>
                        <img src="{{ $user->avatarUrl() }}" class="ui circular centered small image">
                        <br>
                        <div class="ui corner fluid aligned input">
                            <input type="text" placeholder="Cum te cheamă?" value="{{ $user->first_name }} {{ $user->last_name }}">
                        </div>
                        <br>
                        <div class="ui form">
                            <div class="field">
                                <textarea rows=3 placeholder="Spune-ne câte ceva despre tine..."></textarea>
                            </div>
                        </div>
                        <p align="left" id="description" class="ui grey-text">
                            {{ $user->description }}
                        </p>
                    </div>
                </div>
                <div class="column six wide computer eight wide tablet sixteen wide mobile">
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
                <a href="javascript:{}" class="ui green medium circular button"><i class="mdi mdi-check"></i> &nbsp; Salvează modificările</a>
        </div>
    </div>
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