@extends('admin.master.layout')
@section('title', $category->name)
@section('content')
    <div class="container-fluid">
        <div class="card mt-5">
            <h1 class="mt-5 pl-2" > Category is {{ $category->name }}</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-primary mt-5 mb-5">Go Back</a>

        </div>
    </div>
@endsection
