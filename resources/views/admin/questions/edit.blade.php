@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> Create Exam</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.exam.index') }}">Exam</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Exam</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic form elements</h4>
                    <p class="card-description"> Basic form elements </p>
                    <form action="{{ route('dashboard.question.update', ['exam' => $exam->id , 'question' => $question->id ]) }}" method="POST"
                        class="forms-sample row justify-content-around">
                        @csrf

                            <div class="form-group col-5">
                                <label for="title">Title</label>
                                @error("title")
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="title" value="{{ $question->title }}"
                                    class="form-control text-light @error('title') is-invalid @enderror" id="title"
                                    placeholder="title">
                            </div>

                            <div class="form-group col-5">
                                <label for="right_ans">Right Ans.</label>
                                @error('right_ans')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="number" name="right_ans" max="4" min="1" value="{{ $question->right_ans }}"
                                    class="form-control text-light @error('right_ans') is-invalid @enderror" id="right_ans"
                                    placeholder="Right Ans.">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_1">Option (1)</label>
                                @error('option_1')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_1" value="{{ $question->option_1 }}"
                                    class="form-control text-light  @error('option_1') is-invalid @enderror" id="option_1"
                                    placeholder="Option (1)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_2">Option (2)</label>
                                @error('option_2')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_2" value="{{ $question->option_2 }}"
                                    class="form-control text-light  @error('option_2') is-invalid @enderror" id="option_2"
                                    placeholder="Option (2)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_3">Option (3)</label>
                                @error('option_3')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_3" value="{{$question->option_3 }}"
                                    class="form-control text-light  @error('option_3') is-invalid @enderror" id="option_3"
                                    placeholder="Option (3)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_4">Option (4)</label>
                                @error('option_4')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_4" value="{{ $question->option_4 }}"
                                    class="form-control text-light  @error('option_4') is-invalid @enderror" id="option_4"
                                    placeholder="Option (4)">
                            </div>

                        <div class="col-11">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
