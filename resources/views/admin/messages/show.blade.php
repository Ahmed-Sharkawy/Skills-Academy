@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title">Message</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.messages.index') }}">Messages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $message->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-5">
        <div class="col-md-9 offset-md-1 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exam details</h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $message->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $message->email }}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>{{ $message->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Body</th>
                                    <td style="white-space: break-spaces">{{ $message->body }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show Message {{ $message->name }}</h4>
                    <form action="{{ route('dashboard.message.store',$message->id) }}" method="POST"
                        class="forms-sample row justify-content-around">
                        @csrf
                        <div class="form-group col-11">
                            <label for="title">Title</label>
                            @error('title')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control text-light @error('title') is-invalid @enderror" id="title"
                                placeholder="Title">
                        </div>

                        <div class="form-group col-11">
                            <label for="body">Body</label>
                            @error('body')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <textarea name="body" class="form-control text-light  @error('body') is-invalid @enderror" style="height: 150px" id="body">{{ old('body') }}</textarea>
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
