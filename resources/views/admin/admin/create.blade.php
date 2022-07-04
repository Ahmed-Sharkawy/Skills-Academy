@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> Create Admin</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.index') }}">Admins</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Admin</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Create Admin</h4>
                    <form action="{{ route('dashboard.admin.store') }}" method="POST"
                        class="forms-sample row justify-content-around">
                        @csrf
                        <div class="form-group col-5">
                            <label for="name">Name</label>
                            @error('name')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control text-light @error('name') is-invalid @enderror" id="name"
                                placeholder="Name">
                        </div>

                        <div class="form-group col-5">
                            <label for="email">Email</label>
                            @error('email')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control text-light @error('email') is-invalid @enderror" id="name_ar"
                                placeholder="Email">
                        </div>

                        <div class="form-group col-5">
                            <label for="password">Password</label>
                            @error('password')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control text-light @error('password') is-invalid @enderror" id="name_ar"
                                placeholder="Password">
                        </div>

                        <div class="form-group col-5">
                            <label for="password_confirmation">Confirm Password</label>
                            @error('password_confirmation')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control text-light @error('password_confirmation') is-invalid @enderror" id="name_ar"
                                placeholder="Password Confirmation">
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
