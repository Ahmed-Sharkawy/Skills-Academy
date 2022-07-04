@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title">Exams</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.exam.index') }}">Exams</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $exam->name('en') }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-9 offset-md-1 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exam details</h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>Name (en)</th>
                                    <td>{{ $exam->name('en') }}</td>
                                </tr>
                                <tr>
                                    <th>Name (ar)</th>
                                    <td>{{ $exam->name('ar') }}</td>
                                </tr>
                                <tr>
                                    <th>Description (en)</th>
                                    <td style="white-space: break-spaces">{{ $exam->desc('en') }}</td>
                                </tr>
                                <tr>
                                    <th>Description (ar)</th>
                                    <td style="white-space: break-spaces">{{ $exam->desc('ar') }}</td>
                                </tr>
                                <tr>
                                    <th>Skill</th>
                                    <td>{{ $exam->skill->name('en') }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src="{{ asset("uploads/exams/$exam->image") }}" alt="exam">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Questions No.</th>
                                    <td>{{ $exam->questions_no }}</td>
                                </tr>
                                <tr>
                                    <th>Difficulty</th>
                                    <td>{{ $exam->difficulty }}</td>
                                </tr>
                                <tr>
                                    <th>Duration (mins)</th>
                                    <td>{{ $exam->duration_mins }}</td>
                                </tr>
                                <tr>
                                    <th>Active</th>
                                    <td>
                                        @if ($exam->active)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('dashboard.question.show', $exam->id) }}" class="btn btn-success mt-3 mx-3">Show Question</a>
                    <a href="{{ url()->previous() }}" class="btn btn-danger mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
