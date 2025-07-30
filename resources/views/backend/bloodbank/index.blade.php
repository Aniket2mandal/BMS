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
                    <li class="breadcrumb-item"><a href="{{route('bloodbank.index')}}">Bloodbank</a></li>
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">Blood Bank List</h3>

        <div class="card-tools mt-4">
            <a href="{{ route('bloodbank.create') }}" class="btn btn-success">
                Add New BloodBank<i class="fas fa-plus"></i>
            </a>
        </div>


    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class="table">
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($bloodbanks as $bloodbank)
                <tr class="align-middle" id="">
                    <td>{{$i++}}</td>
                    <td>{{$bloodbank->name}}</td>
                    <td>{{$bloodbank->slug}}</td>
                    <td>{{$bloodbank->city}},{{ $bloodbank->district }},{{ $bloodbank->state }}</td>
                    <td>{!! Str::limit($bloodbank->description, 50) !!}</td>
                    <td>
                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="status" class="Status" value="0">
                            <input type="checkbox" name="status" class="Status" data-id="{{$bloodbank->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('status',$bloodbank->status) ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>
                    </td>
                    <td>
                        @if($bloodbank->image)
                        <img src="{{ asset('images/bloodbank/' . $bloodbank->image) }}" alt="Post Image" width="80" height="80">
                        @else
                        <img src="{{ asset('adminlte/img/default-150x150.png') }}" class="img-circle" alt="User Image" width="80" height="80">
                        @endif
                    </td>
                    <td class="">

                        <a href="{{route('bloodbank.edit',$bloodbank->slug)}}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>

                        <button id="delete" data-id="{{$bloodbank->id}}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.Status').change(function() {
            var bloodbankId = $(this).data('id');
            console.log(bloodbankId);
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(Status);
            $.ajax({
                method: 'POST',
                url: '/bloodbank/status/' + bloodbankId,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The user status has been updated.',
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


        $('.delete-btn').click(function() {
            var postId = $(this).data('id');
            console.log(postId);
            swal.fire({
                title: "Are You Sure?",
                text: "Do you want to delete the item ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("yess it is");
                    $.ajax({
                        method: 'GET',
                        url: '/bloodbank/delete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The bloodbank deleted sucessfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                                // Remove the post element from the DOM (you can select the post by its ID or class)
                                $('#post-' + postId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the bloodbank.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        });

    });
</script>
@endsection