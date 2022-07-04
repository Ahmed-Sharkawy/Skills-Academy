@extends('admin.layout.layout')

@section('main')
    <div class="page-header">
        <h3 class="page-title"> Skills </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Skills</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="page-header my-4 mx-4">
                    <h3 class="page-title"> All Skills </h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add-modal"
                        data-whatever="@mdo">Add Skills</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (en)</th>
                                    <th>Name (ar)</th>
                                    <th>Image </th>
                                    <th>Category</th>
                                    <th>Active</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skills as $skill)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $skill->name('en') }}</td>
                                        <td>{{ $skill->name('ar') }} </td>
                                        <td> <img src="{{ asset("uploads/skills/$skill->image") }}" alt="skills"> </td>
                                        <td>{{ $skill->cat->name('en') }} </td>
                                        <td>
                                            @if ($skill->active)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.skill.toggle', $skill->id) }}"
                                                class="btn btn-secondary btn-rounded"><i
                                                    class="mdi mdi-toggle-switch"></i></a>
                                            <button type="button" class="btn btn-success  btn-rounded edit-btn"
                                                data-id="{{ $skill->id }}"
                                                data-nameEn="{{ $skill->name('en') }}"data-nameAr="{{ $skill->name('ar') }}"
                                                data-image="{{ $skill->image }}" data-category="{{ $skill->cat_id }}"
                                                data-bs-toggle="modal" data-bs-target="#update-modal"
                                                data-whatever="@mdo"><i class="mdi mdi-rename-box"></i></button>
                                            <a href="{{ route('dashboard.skill.destroy', $skill->id) }}"
                                                class="btn btn-danger  btn-rounded"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex my-3 justify-content-center">
                    {{ $skills->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Start Create Modal Category --}}
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="ModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Create Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.skill.store') }}" enctype="multipart/form-data"
                        class="forms-sample" id="form-modal-cat">
                        @csrf
                        <div class="form-group">
                            <label for="name_en">Name (en)</label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control"
                                id="name_en" style="color: white">
                        </div>
                        <div class="form-group">
                            <label for="name_ar">Name (ar)</label>
                            <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control"
                                id="name_ar" style="color: white">
                        </div>
                        <div class="form-group">
                            <label for="select">Category</label>
                            <select name="cat_id" class="form-control" id="select" style="color: white">
                                <option>Category1</option>
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-modal-cat" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>

    </div>
    {{-- End Create Modal Category --}}



    {{-- Start Update Modal Category --}}

    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="ModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Create Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.skill.update') }}" enctype="multipart/form-data" class="forms-sample"
                        id="form-modal-update">
                        @csrf
                        <input type="hidden" name="id" id="form-id">
                        <div class="form-group">
                            <label for="name_en">Name (en)</label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control"
                                id="form-name-en" style="color: white">
                        </div>
                        <div class="form-group">
                            <label for="name_ar">Name (ar)</label>
                            <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control"
                                id="form-name-ar" style="color: white">
                        </div>
                        <div class="form-group">
                            <label for="select">Category</label>
                            <select name="cat_id" class="form-control" id="form-name-cat_id" style="color: white">
                                <option>Category1</option>
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-modal-update" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>

    </div>
    {{-- End Update Modal Category --}}
@endsection


@section('script')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id')
            let nameEn = $(this).attr('data-nameEn')
            let nameAr = $(this).attr('data-nameAr')
            let catId = $(this).attr('data-category')

            $('#form-id').val(id)
            $('#form-name-ar').val(nameAr)
            $('#form-name-en').val(nameEn)
            $('#form-name-cat_id').val(catId)
        })
    </script>
@endsection
