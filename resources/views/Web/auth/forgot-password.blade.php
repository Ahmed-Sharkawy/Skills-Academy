@extends('Web.layout.layout')

@section('title')
Forgot Password
@endsection


@section('main')

<!-- Hero-area -->
<div class="hero-area section">

  <!-- Backgound Image -->
  <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('front/img/page-background.jpg')}})"></div>
  <!-- /Backgound Image -->

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 text-center">
        <h1 class="white-text">Forgot Password</h1>
      </div>
    </div>
  </div>

</div>
<!-- /Hero-area -->

<!-- Contact -->
<div id="contact" class="section">

  <!-- container -->
  <div class="container">

    <!-- row -->
    <div class="row">

      <!-- login form -->
      <div class="col-md-6 col-md-offset-3">
        <div class="contact-form">
          <h4>Forgot Password</h4>
          @include('Web.inc.messages')
          <form action="{{ url('forgot-password') }}" method="POST">
            @csrf
            <input class="input" type="email" name="email" placeholder="Email">
            <button type="submit" class="main-button icon-button pull-right">Forgot Password</button>
          </form>
        </div>
      </div>
      <!-- /login form -->

    </div>
    <!-- /row -->

  </div>
  <!-- /container -->

</div>
<!-- /Contact -->

@endsection
