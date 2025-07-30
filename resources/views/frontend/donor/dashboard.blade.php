@extends('frontend.layout.index')

@section('content')
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg" style="background-color: #2E4A5B;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Donor Dashboard</a>
            <div>
                <a href="{{ route('donor.logout') }}" class="btn btn-outline-light" id="logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container text-center my-4">
        <div class="rounded-circle border border-4 border-dark mx-auto"
            style="width: 150px; height: 150px; overflow: hidden;">
            @if($donor->image)
                <img src="{{ asset('/images/donors/' . $donor->image) }}" class="img-fluid" alt="Profile Image">
            @else   
            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Profile Image">
            @endif
        </div>
        <div class="mt-3">
           
                <button type="button" class="btn btn-outline-secondary btn-sm" id="uploadBtn">Upload Image</button>
                <input type="file" name="donorimage" id="donorimage" style="display:none;">
         
        </div>

    </div>

    <!-- Donation Details Table -->
    <div class="container my-5">

        <div class="text-center">
            <h2 style="color: #DD4045;">{{ $donor->name }}'s Donation History</h2>
            <p class="text-muted">Track your contributions and donation details below</p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-danger" style="background-color: #DD4045;">
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Blood Bank</th>
                        <th>Location</th>
                        <th>Blood Group</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bloodbank as $bloodbank)
                        <tr class="text-center">
                            <td>{{ $bloodbank->pivot->donation_date }}</td>
                            <td>{{ $bloodbank->name }}</td>
                            <td>{{ $bloodbank->address }}</td>
                            <td>{{ $donor->blood }}</td>
                            <td><span class="badge text-bg-success">Approved</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#locationModal">Change Password</button>
        </div>
    </div>

    <div class="modal fade" id="locationModal" tabindex="-1"
    aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="locationModalLabel">Donation Detail</h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="locationForm">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="district" class="form-label">New Password</label>
                        <input type="text" class="form-control" name="password"
                            id="password" placeholder="Enter new password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">cancel</button>
                    <button type="submit" class="btn btn-danger">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#logout").on('click', function(event) {
            event.preventDefault(); 

            $.ajax({ 
                url: '/donor/logout',
                type: 'GET',
                 success: function(response) {
                    swal.fire({
                        title: 'Success',
                        text: 'You have been logged out successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        location.reload();
                    });
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#uploadBtn').click(function() {
            $('#donorimage').click();
        });
        $('#donorimage').change(function() {
            var csrfToken = '{{ csrf_token() }}';
            var file = this.files[0];
            console.log(file);
            var formData = new FormData();
            formData.append('image', file);
           
            console.log(formData);
            $.ajax({
                url: '/donor/uploadimage',
                type: 'post',
                headers: {
                'X-CSRF-TOKEN': csrfToken // Ensure this meta tag exists
            },
                data: formData,
                processData: false, // Important for file uploads
                contentType: false, // Important for file uploads
                success: function(response) {
                   swal.fire({
                        title: 'Success',
                        text: 'Image uploaded successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        // Reload the page to show the new image
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    swal.fire({
                        title: 'Error',
                        text: 'Failed to upload image: ' + error,
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
        $('#locationForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: '/donor/changepassword',
                type: 'POST',
                data: formData,
                success: function(response) {
                    swal.fire({
                        title: 'Success',
                        text: 'Password changed successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        // Optionally, you can redirect or reload the page
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    swal.fire({
                        title: 'Error',
                        text: 'Failed to change password: ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>