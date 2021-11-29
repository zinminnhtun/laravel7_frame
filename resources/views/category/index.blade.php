@extends('layouts.app')

@section("title") Category Manager @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Category Manager</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-layers"></i> Category Manager
                    </h4>
                    <hr>
                    <form action="{{ route('category.store') }}" class="" method="post">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control form-control-lg w-25 d-inline-block mr-2 @error('title') is-invalid @enderror"
                                   placeholder="New Category" required>
                            <button type="submit" class="btn btn-primary btn-lg">Add</button>
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

