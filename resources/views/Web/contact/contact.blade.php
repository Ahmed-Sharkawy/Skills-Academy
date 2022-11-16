@extends('Web.layout.layout')

@section('title')
Skills Hub
@endsection

@section('main')
<!-- Hero-area -->
<div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('front/img/page-background.jpg') }})">
    </div>
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

                    <form id="contact_form">
                        @csrf
                        <span class="text-danger input_name"></span>
                        <input class="input contact_form" type="text" name="name" placeholder="Name">
                        <span class="text-danger input_subject"></span>
                        <input class="input contact_form" type="text" name="subject" placeholder="Subject">
                        <span class="text-danger input_email"></span>
                        <input class="input contact_form" type="email" name="email" placeholder="Email">
                        <span class="text-danger input_message"></span>
                        <textarea class="input contact_form" name="message" placeholder="Enter your Message"></textarea>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

<script>
    const form = $('#contact_form');

    form.submit(function(e) {
        e.preventDefault();

        $('.input_name').empty();
        $('.input_subject').empty();
        $('.input_email').empty();
        $('.input_message').empty();

        const formData = new FormData(form[0]);

        axios.post("{{ route('contact.store') }}", formData)
            .then((response) => {
                window.location.reload();
            })
            .catch((errors) => {
                $.each(errors.response.data.errors, function(key, item) {
                    $(`.input_${key}`).show()
                    $(`.input_${key}`).text(item[0])
                    // toastr.error(item)
                })
            });
    });


    // $('#success-div').hide()
    // $('#danger-div').hide()
    // $('#contact_form_btn').sub(function(e) {
    //     $('#success-div').hide()
    //     $('#success-div').empty()
    //     $('#danger-div').hide()
    //     $('#danger-div').empty()

    //     e.preventDefault();
    //     let formData = new FormData($('#contact_form')[0]);
    //     $.ajax({
    //         method: "POST",
    //         url: "{{ route('contact.store') }}",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {
    //             // $('#success-div').show()
    //             // $('#success-div').text(data.success)
    //             toastr.success(data.success)
    //             $('#contact_form')[0].reset();
    //         },
    //         error: function(xhr, status, error) {
    //             $('#danger-div').show()

    //             $.each(xhr.responseJSON.errors, function(key, item) {
    //                 // $('#danger-div').append(`<p> ${item} </p>`)
    //                 toastr.error(item)
    //             })

    //         }
    //     })
    // })

</script>
@endsection
