@extends('master')

@section('title', 'Pagina nu există')

@section('content')
  <main>
    <section class="login section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-warning">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container py-lg-md d-flex">
        <div class="col ml-3 mr-3 px-0">
          <div class="row">
            <div class="col-lg-6">
              <h1 class="display-3  text-white">
                Pagina nu există!
                <span>Dar dacă nu e așa?</span>
              </h1>
              <p class="lead text-white">
                Foarte probabil ai primit link-ul greșit. Sau ai făcut ceva de te-a adus aici. Întoarce-te la pagina principală.
              </p>
              <div class="btn-wrapper">
                <a href="{{ route('home') }}" class="btn btn-info btn-icon mb-3 mb-sm-0">
                  <i class="mdi mdi-arrow-right mr-2"></i> Către pagina principală
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
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