@extends('Web.layout.layout')

@section('main')
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>Sign In</h4>
                        <form action="{{ url('email/verification-notification') }}" method="POST">
                            @csrf
                            <button type="submit" class="main-button icon-button pull-right">Sign In</button>
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
