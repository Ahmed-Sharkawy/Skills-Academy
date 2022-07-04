@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> Admin </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">users</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> All users </h3>
                    <a href="{{ route('dashboard.admin.create') }}" class="btn btn-info">Add Admin</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }} </td>
                                        <td>{{ $user->role->name }} </td>
                                        <td>
                                            @if ($user->email_verified_at)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->role->name == 'student')
                                                <a href="{{ route('dashboard.admin.promotion',$user->id) }}"
                                                    class="btn btn-success btn-rounded"><i
                                                        class="mdi mdi-briefcase-upload"></i></a>
                                            @else
                                                <a href="{{ route('dashboard.admin.rebate', $user->id) }}"
                                                    class="btn btn-danger btn-rounded"><i class="mdi mdi-briefcase-download"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex my-3 justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
