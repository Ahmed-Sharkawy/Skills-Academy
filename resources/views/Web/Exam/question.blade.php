@extends('Web.layout.layout')

@section('title')
  Exam:question
@endsection

@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/blog-post-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="category.html">Category name</a></li>
                        <li><a href="category.html">Skill name</a></li>
                        <li>Exam name</li>
                    </ul>
                    <h1 class="white-text">Exam name</h1>
                    <ul class="blog-post-meta">
                        <li>18 Oct, 2017</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> 35</a></li>
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
                        <p>
                          @foreach ($questions as $index => $question)

                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h3 class="panel-title">{{ $index + 1}} - {{ $question->title }} ?</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                          {{ $question->option_1 }}
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                          {{ $question->option_2 }}
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                          {{ $question->option_3 }}
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
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
                        <button class="main-button icon-button pull-left">Submit</button>
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

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
