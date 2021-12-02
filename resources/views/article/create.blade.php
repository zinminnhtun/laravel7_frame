@extends('layouts.app')

@section("title") Create Article @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article Lists</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Article</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-plus-circle"></i> Create Article
                    </h4>
                    <form action="{{ route('article.store') }}" id="createArticle" method="post">
                        @csrf

                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="">
                        <label>Select Category</label>
                        <select name="category" form="createArticle"
                                class="custom-select custom-select-lg @error('category') is-invalid @enderror" id="">
                                <option value="">Select Category</option>
                                <option value="25">Select Category1</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id}}" {{ old("category") == $category->id ? "selected" : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Article Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" form="createArticle"
                               class="form-control form-control-lg @error('title') is-invalid @enderror">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Article Description</label>
                        <textarea name="description" id="" form="createArticle"
                                  class="form-control form-control-lg @error('description') is-invalid @enderror"
                                  rows="15">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="">
                        <button class="btn btn-lg btn-primary w-100" form="createArticle">Create Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
