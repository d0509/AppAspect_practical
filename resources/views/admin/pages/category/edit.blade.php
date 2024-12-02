@extends('admin.master.layout')
@if (isset($category))
    @section('title', $category->name . ' edit')
@else
    @section('title', 'Create Category')
@endif
@section('content')
    <div class="container-fluid">
        @if (isset($category))
            <form action="{{ route('categories.update', ['category' => $category]) }}" method="POST">
                @method('PUT')
                @csrf
            @else
                <form action="{{ route('categories.store') }}" method="POST">
        @endif
        @csrf

        <div class="form-outline mb-4">
            <label class="form-label" for="form7Example1">Event Name</label>
            <input type="text" name="name" id="name" class="form-control " placeholder="Enter event name"
                value="{{ isset($category) ? old('name', $category->name) : old('name') }}" />
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        @if (isset($category))
            <button type="submit" class="btn btn-primary mb-5">Update Category</button>
        @else
            <button type="submit" class="btn btn-primary mb-5">Add Event</button>
        @endif
        </form>
    </div>

@endsection
