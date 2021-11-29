@extends('layouts.app')

@section("title") Sample @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="#">Sample</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sample Page</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-feather"></i>
                    </h4>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda expedita fuga ipsum magnam omnis recusandae repudiandae soluta! Atque cum, dolor dolores error inventore molestiae placeat, quia quo reprehenderit rerum suscipit.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
