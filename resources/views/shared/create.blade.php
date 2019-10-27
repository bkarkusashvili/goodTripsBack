@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    <h3 class="mb-3">Users</h3>
    <form method="POST" class="row" action="{{isset($data['action']) ? route($data['action']) : route($data['model'].'.store')}}">
        @csrf
        <div class="col-8">
            <div class="row">
                @foreach ($data['main'] as $item)
                    @switch($item['type'])
                        @case('textarea')
                        @case('image')
                        @case('radio')
                        @case('checkbox')
                            @include('shared.inputs.checkbox', ['input' => $item])
                            @break
                        @default
                            @include('shared.inputs.text', ['input' => $item])
                    @endswitch
                @endforeach
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </div>
                @foreach ($data['aside'] as $item)
                    @switch($item['type'])
                        @case('textarea')
                        @case('image')
                        @case('radio')
                        @case('checkbox')
                            @include('shared.inputs.checkbox', ['input' => $item])
                            @break
                        @default
                            @include('shared.inputs.text', ['input' => $item])
                    @endswitch
                @endforeach
            </div>
        </div>
    </form>
@endsection