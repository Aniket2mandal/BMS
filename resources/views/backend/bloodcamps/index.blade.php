@extends('backend.layout.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bloodcamp.index') }}">Bloodcamps</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title mt-4">Blood Camp List</h3>
 
            @can('create-camp', App\Models\BloodCamp::class)
            <div class="card-tools mt-4">
                <a href="{{ route('bloodcamp.create') }}" class="btn btn-success">
                    Add New BloodCamp<i class="fas fa-plus"></i>
                </a>
            </div>
@endcan

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped mt-4">
                <thead class="table table-dark">
                    <tr class="table">
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Bloodbank</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($camps as $camp)
                        <tr class="align-middle" id="">
                            <td>{{ $i++ }}</td>
                            <td>{{ $camp->name }}</td>
                            <td>{{ $camp->address }}</td>
                            <td>{!! Str::limit($camp->description, 50) !!}</td>
                            <td>
                                @foreach ($camp->bloodBanks as $bloodbank)
                                    {{ $bloodbank->name }}
                                @endforeach
                            </td>
                            <td>
                                @can('change-camp-status', $camp)
                                    <div class="form-group ">
                                        <!-- Toggle switch (default checked for Active) -->
                                        <input type="hidden" name="status" class="Status" value="0">
                                        <input type="checkbox" name="status" class="Status" data-id="{{ $camp->id }}"
                                            data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success"
                                            data-offstyle="danger" value="1"
                                            {{ old('status', $camp->status) ? 'checked' : '' }}>
                                        <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                                    </div>
                                @endcan
                            </td>
                            <td>
                                @if ($camp->image)
                                    <img src="{{ asset('images/camps/' . $camp->image) }}" alt="Post Image" width="80"
                                        height="80">
                                @else
                                    <img src="{{ asset('adminlte/img/default-150x150.png') }}" class="img-circle"
                                        alt="User Image" width="80" height="80">
                                @endif
                            </td>
                            <td>{{ $camp->date }}</td>
                            <td>{{ $camp->time }}</td>
                            <td class="">
                                @can('edit-camp', $camp)
                                    <a href="{{ route('bloodcamp.edit', $camp->id) }}" class="btn btn-primary btn-sm me-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan
                                @can('delete-camp', $camp)
                                    <button id="delete" data-id="{{ $camp->id }}"
                                        class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="card-footer clearfix">
                {{ $camps->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.Status').change(function() {
                var campId = $(this).data('id');
                console.log(campId);
                var Status = $(this).prop('checked') ? '1' : '0';
                console.log(Status);
                $.ajax({
                    method: 'POST',
                    url: '/bloodcamp/status/' + campId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'Status': Status
                    },
                    success: function(response) {

                        // SweetAlert2 success popup
                        Swal.fire({
                            title: 'Success!',
                            text: 'The status has been updated.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                            // Remove the post element from the DOM (you can select the post by its ID or class)
                            // $('#post-' + postId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'The is error updating status !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var campId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/bloodcamp/delete/' + campId,
                            type: 'GET',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'The blood camp has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the blood camp.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
