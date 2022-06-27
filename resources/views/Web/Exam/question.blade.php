@extends('Web.layout.layout')

@section('title')
    Exam : question
@endsection

@section('css')
    <link href="{{ asset('front/css/TimeCircles.css') }}" rel="stylesheet">
@endsection

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('front/img/blog-post-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href=" {{ route('home') }} ">Home</a></li>
                        <li><a
                                href=" {{ route('categories.show', $exam->skill->cat->id) }} ">{{ $exam->skill->cat->name() }}</a>
                        </li>
                        <li><a href=" {{ route('skill.show', $exam->skill->id) }} ">{{ $exam->skill->name() }}</a></li>
                        <li>{{ $exam->name() }}</li>
                    </ul>
                    <h1 class="white-text">{{ $exam->name() }}</h1>
                    <ul class="blog-post-meta">
                        <li> {{ Carbon\Carbon::parse($exam->created_at)->format('d M, Y') }} </li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                {{ $exam->users()->count() }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">
                    <form id="exam-submit-form" action="{{ route('exam.submit', $exam->id) }}" method="post">
                        @csrf
                    </form>
                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <p>
                            @foreach ($questions as $index => $question)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{ $index + 1 }} - {{ $question->title }} ?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="1"
                                                    form="exam-submit-form">
                                                {{ $question->option_1 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="2"
                                                    form="exam-submit-form">
                                                {{ $question->option_2 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="3"
                                                    form="exam-submit-form">
                                                {{ $question->option_3 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="4"
                                                    form="exam-submit-form">
                                                {{ $question->option_4 }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </p>
                    </div>
                    <!-- /blog post -->

                    <div>
                        <button type="submit" form="exam-submit-form"
                            class="main-button icon-button pull-left">Submit</button>
                        <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
                    </div>
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">Skill: programming</li>
                        <li class="list-group-item">Questions: {{ $exam->questions_no }}</li>
                        <li class="list-group-item">Duration: {{ $exam->duration_mins }} mins</li>
                        <li class="list-group-item">Difficulty:
                            @for ($i = 1; $i <= $exam->difficulty; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($j = 1; $j <= 5 - $exam->difficulty; $j++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </li>
                    </ul>
                    <!-- /exam details widget -->
                    <div class="duration-countdown" data-timer="10"></div>
                    {{-- <div class="duration-countdown" data-timer=" {{ $exam->duration_mins * 60 }} "></div> --}}
                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('front/js/TimeCircles.js') }}"></script>

    <script>
        $(".duration-countdown").TimeCircles({
            time: {
                Days: {
                    show: false
                }
            },
            count_past_zero: false,
        }).addListener(function(unit, value, total) {
            if (total <= 0) {
                $('#exam-submit-form').submit()
            }
        });
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{!! $error !!}", "timeOut");
                toastr.options.closeButton = true; //
                toastr.options.timeOut = '80000'; // 3s
            </script>
        @endforeach
    @endif
@endsection
