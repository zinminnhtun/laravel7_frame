@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <i class="fas fa-home"></i>
                        {{ __('You are logged in!') }}
                        <button class="test btn btn-primary">test</button>

                        <br>

                        {{--                        {{route('article.destroy',[1,'page'=>1])}}--}}
                        {{--                    {{ Request::url() }}--}}
                        {{--                     {{ (\App\Category::all()->pluck('id')) }}--}}
                        <pre>
                    @php
                        $arr = ["Vue","React","Node Js", "Express Js","Laravel","Javascript","Php","Firebase"];
 echo array_shift($arr);




                    @endphp
                    </pre>


                    </div>
                </div>
            </div>
        </div>
        {{ B::$name }}
    </div>
@endsection
@section('foot')
    <script>
        $(".test").click(function () {
            alert("hello");
        })
    </script>
@endsection
