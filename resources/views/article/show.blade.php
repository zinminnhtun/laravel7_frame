@extends('layouts.app')

@section("title") {{ $article->title }} @endsection
@section('head')
    <style>
        .description{
            white-space: pre-line;
        }
    </style>
@endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article Detail</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        {{ $article->title }}
                    </h4>
                    <div class="mt-2 mb-3 text-primary">
                        <span class="small font-weight-bold mr-2"><i class="feather-layers"></i> {{ $article->category->title }}</span>
                        <span class="small font-weight-bold mr-2"><i class="feather-user"></i> {{ $article->user->name }}</span>
                        <span class="text-nowrap small font-weight-bold mr-2">
                            <i class="fas fa-calendar-alt"></i> {{ $article->created_at->format("d-m-Y") }}
                        </span>
                        <span class="text-nowrap small font-weight-bold mr-2">
                            <i class="fas fa-clock"></i> {{ $article->created_at->format("h:i a") }}
                        </span>
                    </div>
                    @if(session('status'))
                        {!! session('status') !!}
                    @endif
                    <p class="text-black-50 description">{{ $article->description }}</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <a href="{{ route('article.edit',$article->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                            <div class="btn btn-outline-danger btn-sm" onclick="if (confirm('Are you sure to delete this article?')){event.preventDefault();document.getElementById('delete-article{{$article->id}}').submit()};">
                                <i class="fas fa-trash-alt fa-fw"></i>
                            </div>
                            <a href="{{ route('article.index') }}" class="btn btn-outline-dark btn-sm">
                                All Articles
                            </a>
                        </div>
                        <p>{{ $article->created_at->diffForHumans() }}</p>
                    </div>
                    <form action="{{ route('article.destroy',[$article->id,'page'=>request()->page]) }}" id="delete-article{{$article->id}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
