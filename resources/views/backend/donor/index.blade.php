@extends('backend.layout.app')

@section('content')
    <!-- Use Bootstrap 4 instead of 5 -->


    <!-- SweetAlert for session success message -->
    <!-- Store Success Message in a Hidden Input Field -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('donor.index') }}">Donors</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card-header mt-4">
        <h3 class="card-title">Donor List</h3>
        <div class="card-tools d-flex align-items-center gap-2">
            <form class="d-flex"id="searchForm">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search"
                    style="width: 150px;">
                <button class="btn btn-danger btn-sm ms-2" id="resetbtn">
                    Cancel
                </button>
            </form>
            @can('create-donor', App\Models\Donor::class)
                <div class="input-group-append">
                    <a href="{{ route('donor.create') }}" class="btn btn-success">
                        Add New Donor <i class="fas fa-plus"></i>
                    </a>
                </div>
            @endcan
        </div>
    </div>


    <div class="card-body">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class="table">
                    <!-- <th style="width: 10px"></th> -->
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Allergies</th>
                    <th>Blood Group</th>
                    <th>Quantity</th>
                    <th>Donation Bank</th>
                    <th>Donation Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @if ($donor->isNotEmpty())
                    @foreach ($donor as $donors)
                        <tr class="align-middle" id="">
                            <td>{{ $i++ }}</td>
                            <td>{{ $donors->name }}</td>
                            <td>{{ $donors->email }}</td>
                            <td>{{ $donors->phone }}</td>
                            <td>{{ $donors->address }}</td>
                            <td>{{ implode(', ', json_decode($donors->allergy)) }}</td>
                            <td>{{ $donors->blood }} </td>
                            <td>
                                @if ($donors->bloodBanks)
                                    @foreach ($donors->bloodBanks as $bloodbank)
                                        {{ $bloodbank->pivot->quantity_donated ?? 0}} Pints<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($donors->bloodBanks)
                                    @foreach ($donors->bloodBanks as $bloodbank)
                                        {{ $bloodbank->name }}<br>
                                        {{-- {{ $donors->bloodBanks->name }} --}}
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($donors->bloodBanks)
                                    @foreach ($donors->bloodBanks as $bloodbank)
                                        {{ $bloodbank->pivot->donation_date }}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('add-bloodbank',$donors)
                                <button class="btn btn-success btn-sm addbloodbank" data-id="{{ $donors->id }}"
                                    data-email="{{ $donors->email }}" data-toggle="modal" data-target="#locationModal">
                                    <i class="fas fa-plus"></i> <b>Add Bloodbank</b></button>
                                @endcan
                                
                                @can('edit-donor', $donors)
                                    <a href="{{ route('donor.edit', $donors->id) }}"
                                        class="btn btn-primary btn-sm me-2 d-inline">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>




        <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0 rounded">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="locationModalLabel">Donation Detail</h5>
                        <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="locationForm">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="district" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="Quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="quantity" id="quantity"
                                    placeholder="10 units">
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">Blood Bank</label>
                                <select class="form-control" name="bloodbank" id="bloodbank">
                                    <option value="" disabled selected>Select Blood Bank</option>
                                    {{-- <pre>{{ var_dump($bloodbank) }}</pre> --}}
                                    @foreach ($userBloodBanks as $bank)
                                        <option value="{{ $bank->id }}"
                                            {{ old('bloodbank', isset($bank) ? 'selected' : '') }}>{{ $bank->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Donation date</label>
                                <input type="date" class="form-control" name="date" id="date"
                                    placeholder="Enter email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-dark">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- Pagination -->
    <div class="card-footer clearfix">
        {{ $donor->links('pagination::bootstrap-4') }}
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.Status').change(function() {
                var donorId = $(this).data('id');
                var Status = $(this).prop('checked') ? '1' : '0';
                console.log(Status);
                $.ajax({
                    method: 'POST',
                    url: '/donorstatus/' + donorId,
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
                var bloodId = $(this).data('id');
                console.log(bloodId);
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
                            url: '/blood/delete/' + bloodId,

                            success: function(response) {

                                // SweetAlert2 success popup
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The user deleted sucessfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                    // Remove the post element from the DOM (you can select the post by its ID or class)
                                    $('#post-' + bloodId)
                                        .remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle any errors
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting the user.',
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


    <script>
        $(document).ready(function() {
            $("#searchForm").on('input', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('donor.search') }}",
                    type: "GET",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            var donors = response.data;
                            var html = "";
                            let i = 1;

                            donors.forEach(function(donor) {
                                let allergies = donor.allergy ? JSON.parse(donor
                                    .allergy).join(', ') : '-';
                                let bloodBanks = donor.blood_banks && donor.blood_banks
                                    .length > 0 ?
                                    donor.blood_banks.map(b => b.name).join(', ') :
                                    '-';

                                html += `
                                        <tr class="align-middle">
                                            <td>${i++}</td>
                                            <td>${donor.name}</td>
                                            <td>${donor.email ?? '-'}</td>
                                            <td>${donor.phone ?? '-'}</td>
                                            <td>${donor.address ?? '-'}</td>
                                            <td>${allergies}</td>
                                            <td>${donor.blood ?? '-'}</td>
                                            <td>${donor.quantity_donated ?? '-'}</td>
                                            <td>${bloodBanks}</td>
                                            <td>${donor.donation_date ?? '-'}</td>
                                            <td>
                                                <a href="/donor/${donor.id}/edit" class="btn btn-primary btn-sm me-2 d-inline">
                                                    <i class="fas fa-pencil-alt"></i> 
                                                </a>
                                                <button class="delete-btn btn btn-danger btn-sm" data-id="${donor.id}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-plus"></i> <b>Add Bloodbank</b>
                                                </button>
                                            </td>
                                        </tr>
                                    `;
                            });

                            $("tbody").html(html);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Search failed:", error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while searching.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $("#resetbtn").on('click', function(event) {
                location.reload();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".addbloodbank").on('click', function(event) {
                var id = $(this).data('id');
                console.log(id);
                var email = $(this).data('email');
                $("#email").val(email);
            });

            $("#locationForm").on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: "{{ route('donor.addbloodbank') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Blood bank added successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding blood bank:", error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while adding the blood bank.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        })
    </script>
@endsection
