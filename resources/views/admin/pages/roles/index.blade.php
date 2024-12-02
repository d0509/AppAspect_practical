@extends('admin.master.layout')
@section('title', 'Roles')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        </div>
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Guard</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                    </tr>
                @empty
                    <tr>
                        <p>No Data Found!</p>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>
@endsection
