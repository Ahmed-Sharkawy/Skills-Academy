@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title">Show Score {{ $user->name }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.student.index') }}">Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Score {{ $user->name }}</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> Show Scor </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Exam</th>
                                    <th>Score</th>
                                    <th>Time (mins)</th>
                                    <th>At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exam->name('en') }}</td>
                                        <td>{{ $exam->pivot->score }} </td>
                                        <td>{{ $exam->pivot->time_mins }} </td>
                                        <td>{{ $exam->pivot->created_at }} </td>
                                        <td>
                                            @if ($exam->pivot->status == 'opened')
                                                <span class="badge badge-success">Opened</span>
                                            @else
                                                <span class="badge badge-danger">Closed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($exam->pivot->status == 'closed')
                                                <a href="{{ route('dashboard.student.open.exam', ['user' => $user->id, 'exam' => $exam->id]) }}"
                                                    class="btn btn-success btn-rounded"><i
                                                        class="mdi mdi-lock-open-outline"></i></a>
                                            @else
                                                <a href="{{ route('dashboard.student.closed.exam', ['user' => $user->id, 'exam' => $exam->id]) }}"
                                                    class="btn btn-danger btn-rounded"><i class="mdi mdi-lock"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
