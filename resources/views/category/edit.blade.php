@extends('layouts.app')

@section("title") Category Manager @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route("category.index") }}">Category Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-layers"></i> Edit Category
                    </h4>
                    <hr>
                    <form action="{{ route('category.update',$category->id) }}" class="" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-2">
                            <input type="text" name="title" value="{{ old('title',$category->title) }}" class="form-control form-control-lg w-25 d-inline-block mr-2 @error('title') is-invalid @enderror"
                                   placeholder="Edit Category" required>
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>
                    @include("category.list")

                </div>
            </div>
        </div>
    </div>
@endsection

