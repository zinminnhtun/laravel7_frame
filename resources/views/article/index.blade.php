@extends('layouts.app')

@section("title") Article List @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-list"></i>
                        Article List
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a href="{{ route('article.create') }}" class="btn btn-lg btn-outline-primary mr-3">
                                <i class="feather-plus-circle"></i>Create Article
                            </a>
                            @isset(request()->search)
                                <a href="{{ route('article.index') }}" class="btn btn-sm btn-outline-dark mr-3">
                                    <i class="feather-list"></i>All Article
                                </a>
                                <span class="h5">Search by : "{{ request()->search }}"</span>
                            @endisset
                        </div>
                        <form action="{{ route('article.index') }}" class="" method="get">
                            <div class="form-inline mb-2">
                                <input type="text" name="search" value="{{ request()->search }}" class="form-control form-control-lg mr-2"
                                       placeholder="Search">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="feather-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    @if(session('status'))
                        {!! session('status') !!}
                    @endif
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <td>Category</td>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ Str::words($article->title,5) }}</span>
                                    <br>
                                    <small class="text-black-50">{{ Str::words($article->description,5) }}</small>
                                </td>
                                <td>{{ $article->category->title }}</td>
                                <td>
                                    @isset($article->user)
                                        {{ $article->user->name }}
                                    @endisset
                                </td>
                                <td>
                                    <span class="d-flex justify-content-around align-items-center">
                                         <a href="{{ route('article.show',[$article->id,'page'=>request()->page]) }}" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-info-circle fa-fw"></i>
                                        </a>
                                        <a href="{{ route('article.edit',$article->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                        <div class="btn btn-outline-danger btn-sm" onclick="if (confirm('Are you sure to delete this article?')){event.preventDefault();document.getElementById('delete-article{{$article->id}}').submit()};">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </div>

                                    </span>
                                    <form action="{{ route('article.destroy',[$article->id,'page'=>request()->page]) }}" id="delete-article{{$article->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                                <td class="text-wrap">
                                    <span class="text-nowrap"><i class="fas fa-calendar-alt"></i> {{ $article->created_at->format("d-m-Y") }}</span>
                                    <br>
                                    <span class="text-nowrap"><i
                                            class="fas fa-clock"></i> {{ $article->created_at->format("h:i a") }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no articles</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{$articles->appends(request()->all())->links() }}
                        <p class="font-weight-bold mb-0">Total : {{ $articles->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
