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
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">User</a></li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header ">
            <div class="card-title">Create User</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!--begin::Body-->
            <div class="card-body">

                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="Name" class="form-control" id="name" value="{{ old('Name') }}">
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" id="email" value="{{ old('Email') }}">
                    @error('Email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Image" class="form-label">Profile Image</label>
                    <input type="file" name="image" class="form-control" id="Image" onchange="previewImage(event)">
                    <!-- Image Preview -->
                    <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                        <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">
                    </div>

                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Status" class="form-label">Status:</label>
                    <input type="hidden" name="Status" value="0">
                    <input type="checkbox" name="Status" id="status" value="1"
                        data-toggle="toggle" data-on="Active" data-off="Inactive"
                        data-onstyle="success" data-offstyle="danger">
                    <small class="form-text text-muted">Switch to set the status to active or inactive</small>

                    @error('Status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Role" class="form-label">Select Roles</label>
                    <select name="Role[]" id="Permission" class="form-control select2" multiple>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->id, old('Role', [])) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Error Message --}}
                    @error('Role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="Bloodbank" class="form-label">Select Bloodbank</label>
                    <select name="bloodbank" id="bloodbank" class="form-control" >
                        @foreach($bloodbank as $bloodbanks)
                        <option value="{{ $bloodbanks->id }}"
                            {{ $bloodbanks->id, old('Bloodbank', '') ? 'selected' : '' }}>
                            {{ $bloodbanks->name }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Error Message --}}
                    @error('Role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

    </div>
    <!--end::Body-->

    <!--begin::Footer-->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('user.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
    </div>
    <!--end::Footer-->
    </form>
    <!--end::Form-->
</div>
<!--end::Quick Example-->
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            var previewContainer = document.getElementById('imagePreviewContainer');

            output.src = reader.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>



@endsection