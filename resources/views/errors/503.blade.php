@extends('master')

@section('title', 'Pregătim lucruri tari!')

@section('content')
  <main>
    <section class="login section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-success">
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
                Pregătim lucruri tari,
                <span>doar ai răbdare!</span>
              </h1>
              <p class="lead text-white">
                Pagina este în curs de actualizare. În mod normal, durează mai puțin de 60 de secunde.
              </p>
              <div class="btn-wrapper">
                <a href="{{ request()->url() }}" class="btn btn-info btn-icon mb-3 mb-sm-0">
                  <i class="mdi mdi-refresh mr-2"></i> Refresh
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
    $(document).ready(function () {
      //
    });
  </script>
@endsection

@section('css')

@endsection