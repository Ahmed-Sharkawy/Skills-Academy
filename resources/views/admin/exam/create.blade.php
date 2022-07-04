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
                    <form action="{{ route('dashboard.exam.store') }}" method="POST"
                        class="forms-sample row justify-content-around" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-5">
                            <label for="name_en">Name (en)</label>
                            @error('name_en')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="name_en" value="{{ old('name_en') }}"
                                class="form-control text-light @error('name_en') is-invalid @enderror" id="name_en"
                                placeholder="Name en">
                        </div>

                        <div class="form-group col-5">
                            <label for="name_ar">Name (ar)</label>
                            @error('name_ar')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control text-light @error('name_ar') is-invalid @enderror" id="name_ar"
                                placeholder="Name ar">
                        </div>

                        <div class="form-group col-5">
                            <label for="skill">Skill</label>
                            @error('skill_id')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <select name="skill_id" class="form-control text-light @error('skill_id') is-invalid @enderror" id="skill">
                                <option value="0">Selected</option>
                                @foreach ($skills as $skill)
                                    <option {{ old('skill_id') == $skill->id ? "selected" : "" }} value="{{ $skill->id }}"> {{ $skill->name('en') }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-5">
                            <label>Upload Image</label>
                            @error('image')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="file" name="image" class="file-upload-default  @error('image') is-invalid @enderror">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info  @error('image') is-invalid @enderror" disabled=""
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="questions_no">Questions (no)</label>
                            @error('questions_no')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="number" name="questions_no" value="{{ old('questions_no') }}" class="form-control text-light  @error('questions_no') is-invalid @enderror" id="questions_no"
                                placeholder="questions no">
                        </div>

                        <div class="form-group col-3">
                            <label for="difficulty">Difficulty</label>
                            @error('difficulty')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="number" name="difficulty" value="{{ old('difficulty') }}" max="5" min="1" class="form-control text-light  @error('difficulty') is-invalid @enderror" id="difficulty"
                                placeholder="difficulty">
                        </div>

                        <div class="form-group col-3">
                            <label for="duration_mins">Duration (mins)</label>
                            @error('duration_mins')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="number" name="duration_mins" value="{{ old('duration_mins') }}" class="form-control text-light  @error('duration_mins') is-invalid @enderror" id="duration (mins)"
                                placeholder="duration (mins)">
                        </div>

                        <div class="form-group col-11">
                            <label for="desc_en">Description (en)</label>
                            @error('desc_en')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <textarea name="desc_en" class="form-control text-light  @error('desc_en') is-invalid @enderror" style="height: 150px" id="desc_en">{{ old('desc_en') }}</textarea>
                        </div>

                        <div class="form-group col-11">
                            <label for="desc_ar">Description (ar)</label>
                            @error('desc_ar')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <textarea name="desc_ar" class="form-control text-light  @error('desc_ar') is-invalid @enderror " style="height: 150px;" id="desc_ar">{{ old('desc_ar') }}</textarea>
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
