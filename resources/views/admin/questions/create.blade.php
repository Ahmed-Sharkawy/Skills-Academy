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
                    <form action="{{ route('dashboard.question.store', $exam_id) }}" method="POST"
                        class="forms-sample row justify-content-around">
                        @csrf
                        @for ($i = 1; $i <= $questions_no; $i++)

                            <h3 class='text-warning'>Question {{ $i }}</h3>

                            <div class="form-group col-5">
                                <label for="titles">Title</label>
                                @error("titles[]")
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="titles[]" value="{{ old('titles') }}"
                                    class="form-control text-light @error('titles') is-invalid @enderror" id="titles"
                                    placeholder="titles">
                            </div>

                            <div class="form-group col-5">
                                <label for="right_ans">Right Ans.</label>
                                @error('right_ans')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="number" name="right_ans[]" max="4" min="1" value="{{ old('right_ans') }}"
                                    class="form-control text-light @error('right_ans') is-invalid @enderror" id="right_ans"
                                    placeholder="Right Ans.">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_1s">Option (1)</label>
                                @error('option_1s')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_1s[]" value="{{ old('option_1s') }}"
                                    class="form-control text-light  @error('option_1s') is-invalid @enderror" id="option_1s"
                                    placeholder="Option (1)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_2s">Option (2)</label>
                                @error('option_2s')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_2s[]" value="{{ old('option_2s') }}"
                                    class="form-control text-light  @error('option_2s') is-invalid @enderror" id="option_2s"
                                    placeholder="Option (2)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_3s">Option (3)</label>
                                @error('option_3s')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_3s[]" value="{{ old('option_3s') }}"
                                    class="form-control text-light  @error('option_3s') is-invalid @enderror" id="option_3s"
                                    placeholder="Option (3)">
                            </div>

                            <div class="form-group col-5">
                                <label for="option_4s">Option (4)</label>
                                @error('option_4s')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <input type="text" name="option_4s[]" value="{{ old('option_4s') }}"
                                    class="form-control text-light  @error('option_4s') is-invalid @enderror" id="option_4s"
                                    placeholder="Option (4)">
                            </div>
                        @endfor

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
