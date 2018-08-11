@extends('master')

@section('title', 'Profilul candidatului')

@section('content')
    @foreach($users as $user)

    @endforeach

    {{ $users->first }}
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