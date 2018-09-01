@extends('master')

@section('title', 'Mentenanță - Alegeri pentru Consiliul Național al Elevilor')
  <main>
    <section class="section bg-primary section-lg">
      <div class="container text-center pb-3">
        <h1 class="pt-3 mt-3 text-white"><i class="mdi mdi-star"></i></h1>
        <h1 class="text-white">Pregătim lucruri tari! Ai răbdare...</h1>
        <a href="{{ request()->url() }}" class="btn btn-neutral primary-text"><i class="mdi mdi-refresh mr-2"></i> Refresh</a>
      </div>
    </section>
  </main>
@section('content')
    
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
        //
    });
  </script>
@endsection