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
                    <li class="breadcrumb-item active">Edit User</li>
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
        <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!--begin::Body-->
            <div class="card-body">

                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="Name" class="form-control" id="Name" value="{{ old('Name', $user->name ?? '') }}">
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" id="Email" value="{{ old('Email', $user->email ?? '') }}">
                    @error('Email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password"  @if(isset($user)) disabled @endif>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"  @if(isset($user)) disabled @endif>
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Image" class="form-label">Profile Image</label>
                    <input type="file" name="image" class="form-control" id="Image" onchange="previewImage(event)">

                    @if(isset($user) && $user->image)
                    <input type="hidden" name="existing_image" value="{{ $user->image }}">
                    <div class="mt-2">
                        <img src="{{ asset('images/user/' . $user->image) }}" alt="No Image" style="max-height: 100px; max-width: 100px;">
                    </div>
                    @endif

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
                    <input type="checkbox" name="Status" id="Status" value="1"
                        {{ old('Status', isset($user) && $user->status ? 'checked' : '') }}
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
                            {{ in_array($role->id, old('Role', isset($user) ? $user->roles->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Error Message --}}
                    @error('Role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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