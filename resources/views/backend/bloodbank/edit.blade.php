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
                    <li class="breadcrumb-item active">Update</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
</div>
</div>


<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header ">
            <div class="card-title">Edit Bloodbank</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->

        {!! Form::open(['route' => ['bloodbank.update',$bloodbank->slug], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body">
            @include('backend.bloodbank.bloodbankform')
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('bloodbank.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
        </div>
        <!--end::Footer-->
        {!! Form::close() !!}
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
$('#name').on('input', function() {
var name = $(this).val();
// Convert title to lowercase and replace spaces with dashes
var slug = name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
// Remove dashes from the start and end of the slug
slug = slug.replace(/^-+/, '').replace(/-+$/, '');
// Set the generated slug as the value of the slug input
$('#slug').val(slug);
});
});
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            var previewContainer = document.getElementById('imagePreviewContainer');
            var closeButton = document.querySelector('#imagePreviewContainer .btn-close');
            
            // Set the image source
            output.src = reader.result;
            
            // Show the preview container
            previewContainer.style.display = 'block';
            
            // Show the close button
            closeButton.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
@endsection