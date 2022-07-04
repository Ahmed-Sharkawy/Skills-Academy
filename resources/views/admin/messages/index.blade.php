@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> Messages </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Messages</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> All Messages </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>subject</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject ?? '.....' }} </td>
                                        <td>
                                            <a href="{{ route('dashboard.message.show',$message->id) }}"
                                                class="btn btn-primary btn-rounded"><i
                                                    class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex my-3 justify-content-center">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
