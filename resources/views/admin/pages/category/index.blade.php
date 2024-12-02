@extends('admin.master.layout')
@section('title', 'Categories')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categories</h1>
            <a href="{{ route('categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fa-solid fa-user-plus mr-2"></i>Create Category</a>
        </div>
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <?php
                        $showURL = route('categories.show', ['category' => $category->id]);
                        $editURL = route('categories.edit', ['category' => $category->id]);
                        ?>
                        <td>
                            <div class="d-flex">
                                <a href="{{ $showURL }}" class="text-white w-3 btn btn-primary delete_event mr-2">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ $editURL }}" class="text-white w-3 btn btn-primary mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
