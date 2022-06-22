@extends('Web.layout.layout')
@section('title')
    Skills Hub
@endsection

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('front/img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href=" {{ route('home') }} ">Home</a></li>
                        <li>Contact</li>
                    </ul>
                    <h1 class="white-text">Get In Touch</h1>

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

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4>Send A Message</h4>

                        @include('Web.inc.messages_ajax')

                        <form id="contact_form">
                            @csrf
                            <input class="input contact_form" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Name">
                            <input class="input contact_form" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Email">
                            <input class="input contact_form" type="text" name="subject" value="{{ old('subject') }}"
                                placeholder="Subject">
                            <textarea class="input contact_form" name="message" value="{{ old('message') }}" placeholder="Enter your Message"></textarea>
                            <button type="submit" id="contact_form_btn" class="main-button icon-button pull-right">Send
                                Message</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>Contact Information</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i>{{ $setting->email }}</li>
                        <li><i class="fa fa-phone"></i>{{ $setting->phone }}</li>
                    </ul>

                </div>
                <!-- contact information -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection

@section('script')
    <script>
        $('#success-div').hide()
        $('#danger-div').hide()
        $('#contact_form_btn').click(function(e) {
            $('#success-div').hide()
            $('#success-div').empty()
            $('#danger-div').hide()
            $('#danger-div').empty()

            e.preventDefault();
            let formData = new FormData($('#contact_form')[0]);
            $.ajax({
                method: "POST",
                url: "{{ route('contact.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    // $('#success-div').show()
                    // $('#success-div').text(data.success)
                    toastr.success(data.success)
                    $('#contact_form')[0].reset();
                },
                error: function(xhr, status, error) {
                    $('#danger-div').show()

                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $('#danger-div').append(`<p> ${item} </p>`)
                    })

                }
            })
        })
    </script>
@endsection
