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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <?php
                            $showURL = route('roles.show', ['role' => $role->id]);
                            $editURL = route('roles.edit', ['role' => $role->id]);
                            $deleteURL = route('roles.destroy', ['role' => $role->id]);
                            ?>
                            <div class="d-flex">
                                <a href="{{ $showURL }}" class="text-white w-3 btn btn-primary delete_event mr-2">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a data-eventId="' . $row->id . '" onclick="deleteEvent(' . $row->id . ')"
                                    class="text-white w-3 btn btn-danger delete_event mr-2">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{ $editURL }}" class="text-white w-3 btn btn-primary mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </td>
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
@section('contentFooter')
    <script>
        function deleteEvent(id) {
            var id = id;
            // alert(id);
            var url = "{{ route('roles.destroy', ':id') }}";
            url = url.replace(':id', id);
            // alert(url);
            var token = "{{ csrf_token() }}";
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this role?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "JSON",
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}",

                        },
                        success: function() {
                            console.log('deleted successfully');

                            $('#dataTable').DataTable().ajax.reload();
                        }
                    });
                }

            })
        }
    </script>
@endsection
