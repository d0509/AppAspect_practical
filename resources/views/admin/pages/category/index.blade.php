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
                        $deleteURL = route('categories.destroy', ['category' => $category->id]);
                        ?>
                        <td>
                            <div class="d-flex">
                                <a href="{{ $showURL }}" class="text-white w-3 btn btn-primary delete_event mr-2">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ $editURL }}" class="text-white w-3 btn btn-primary mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="javascript:void(0);" data-eventId="1" onclick="deleteEvent({{ $category->id }})"
                                    class="text-white w-3 btn btn-danger delete_event mr-2">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('contentFooter')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>

    <script>
        // Define deleteEvent globally
        function deleteEvent(id) {
            // Define URL dynamically
            var url = "{{ route('categories.destroy', ':id') }}".replace(':id', id);

            // Display confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this inquiry?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to delete the item
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token from meta tag
                        },
                        dataType: "JSON",
                        success: function() {
                            window.location.reload(); // Reload the page after successful deletion
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            // Any other initialization code here
        });
    </script>
@endsection
