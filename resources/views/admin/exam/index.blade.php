@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title">Exams</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Exams</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> All Exams </h3>
                    <!-- Button trigger modal -->
                    <a href="{{ route('dashboard.exam.create') }}" class="btn btn-info">Add Exams</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (en)</th>
                                    <th>Name (ar)</th>
                                    <th>Image </th>
                                    <th>Skill</th>
                                    <th>Question</th>
                                    <th>Active</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exam->name('en') }}</td>
                                        <td>{{ $exam->name('ar') }} </td>
                                        <td> <img src="{{ asset("uploads/exams/$exam->image") }}" alt="exam"> </td>
                                        <td>{{ $exam->skill->name('en') }} </td>
                                        <td>{{ $exam->questions_no }} </td>
                                        <td>
                                            @if ($exam->active)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.exam.show', $exam->id) }}"
                                                class="btn btn-primary btn-rounded"><i
                                                    class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('dashboard.question.show', $exam->id) }}"
                                                class="btn btn-light btn-rounded"><i
                                                    class="mdi mdi-comment-question-outline"></i></a>
                                            <a href="{{ route('dashboard.exam.edit', $exam->id) }}"
                                                class="btn btn-success  btn-rounded"><i
                                                    class="mdi mdi-rename-box"></i></a>
                                            <a href="{{ route('dashboard.exam.toggle', $exam->id) }}"
                                                class="btn btn-secondary btn-rounded"><i
                                                    class="mdi mdi-toggle-switch"></i></a>
                                            <a href="{{ route('dashboard.exam.destroy', $exam->id) }}"
                                                class="btn btn-danger  btn-rounded"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex my-3 justify-content-center">
                    {{ $exams->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
