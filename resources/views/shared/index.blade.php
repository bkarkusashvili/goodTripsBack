@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    <h3 class="mb-3">
        Users
        <a 
            href="{{isset($data['add']) ? route($data['add']) : route($data['model'].'.create') }}" 
            class="btn btn-success ml-2"
        >
            <i class="fas fa-plus-circle"></i>
            Create
        </a>
    </h3>
    @include('flash::message')
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($data['headers'] as $header)
                    <th scope="col">{{$header}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data['rows'] as $row)
                <tr>
                    @foreach ($data['headers'] as $key => $item)
                        @if ($key !== 'actions')
                            <th scope="row">{{$row->$key}}</th>
                        @else
                            <th scope="row" class="d-flex">
                                <a 
                                    href="{{isset($data['edit']) ? route($data['edit'], $row->id) : route($data['model'].'.edit', $row->id) }}" class="mr-2 btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST"
                                    action="{{isset($data['destroy']) ? route($data['destroy'], $row->id) : route($data['model'].'.destroy', $row->id) }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </th>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection