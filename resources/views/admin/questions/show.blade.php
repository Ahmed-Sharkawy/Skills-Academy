@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> {{ $exam->name('en') }} Questions</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.exam.index') }}">Exam</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('dashboard.exam.show', $exam->id) }}">{{ $exam->name('en') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Questions</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> Exams Questions </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Option</th>
                                    <th>right_ans</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam->questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $question->title }}</td>
                                        <td>
                                            1 - {{ $question->option_1 }} |<br>
                                            2 - {{ $question->option_2 }} |<br>
                                            3 - {{ $question->option_3 }} |<br>
                                            4 - {{ $question->option_4 }} |<br>
                                        </td>
                                        <td>{{ $question->right_ans }} </td>
                                        <td>
                                            <a href="{{ route('dashboard.question.edit', ['exam' => $exam->id , 'question' => $question->id ]) }}"
                                                class="btn btn-success  btn-rounded edit-btn"><i
                                                    class="mdi mdi-rename-box"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('dashboard.exam.index') }}" class="btn btn-success mt-3 mx-3">Back All Exam</a>
                    <a href="{{ url()->previous() }}" class="btn btn-danger mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
