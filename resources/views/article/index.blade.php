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
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ Str::words($article->title,5) }}</span>
                                    <br>
                                    <small class="text-black-50">{{ Str::words($article->description,8) }}</small>
                                </td>
                                <td>{{ $article->category->title }}</td>
                                <td>
                                    @isset($article->user)
                                        {{ $article->user->name }}
                                    @endisset
                                </td>
                                <td>
                                    <span class="d-flex justify-content-around align-items-center">
                                        <a href="{{ route('category.edit',$article->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                        <div class="btn btn-outline-danger btn-sm" onclick="if (confirm('Are you sure to delete {{ '"'.$article->title.'"' }}?')){event.preventDefault();document.getElementById('delete-category{{$article->id}}').submit()};">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </div>

                                    </span>
                                    <form action="{{ route('category.destroy',$article->id) }}" id="delete-category{{$article->id}}" method="post">
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
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{$articles->links() }}
                        <p class="font-weight-bold mb-0">Total : {{ $articles->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
