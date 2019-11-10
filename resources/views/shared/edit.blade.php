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
    @include('flash::message')
    <form method="POST" class="row" enctype="multipart/form-data" 
        action="{{isset($data['action']) ? route($data['action'], $data['response']->id) : route($data['model'].'.update', $data['response']->id)}}">
        @csrf
        @method('PUT')
        <div class="col-8">
            <div class="row">
                @foreach ($data['main'] as $item)
                    @php
                        $inputName = $item['name'];
                        $item['value'] = isset($data['response']->$inputName) ? $data['response']->$inputName : null;
                    @endphp
                    @switch($item['type'])
                        @case(in_array($item['type'], ['textarea', 'image', 'select', 'radio', 'checkbox', 'file', 'gallery', 'map']))
                            @include('shared.inputs.'.$item['type'], ['input' => $item])
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
                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
                </div>
                @foreach ($data['aside'] as $item)
                    @php
                        $inputName = $item['name'];
                        $item['value'] = isset($data['response']->$inputName) ? $data['response']->$inputName : null;
                    @endphp
                    @switch($item['type'])
                        @case(in_array($item['type'], ['textarea', 'image', 'select', 'radio', 'checkbox', 'file', 'gallery', 'map']))
                            @include('shared.inputs.'.$item['type'], ['input' => $item])
                            @break
                        @default
                            @include('shared.inputs.text', ['input' => $item])
                    @endswitch
                @endforeach
            </div>
        </div>
    </form>
@endsection