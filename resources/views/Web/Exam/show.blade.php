@extends('Web.layout.layout')

@section('title')
    Exam - {{ $exam->name() }}
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

                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <p> {{ $exam->desc() }} </p>
                    </div>
                    <!-- /blog post -->

                    @if ($pivotRow == null || $pivotRow->status == 'opened')
                        <form action="{{ route('exam.start', $exam->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="main-button icon-button pull-left">Start Exam</button>
                        </form>
                    @endif
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

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
