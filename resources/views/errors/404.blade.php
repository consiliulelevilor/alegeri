@extends('master')

@section('title', 'Ooops - Alegeri pentru Consiliul Național al Elevilor')
  <main>
    <section class="section bg-danger section-lg">
      <div class="container text-center pb-3">
        <h1 class="pt-3 mt-3 text-white"><i class="mdi mdi-link-variant-off"></i></h1>
        <h1 class="text-white">Pagina nu există.</h1>
        <a href="{{ route('home') }}" class="btn btn-neutral danger-text"><i class="mdi mdi-arrow-left mr-2"></i> Pagina principală</a>
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