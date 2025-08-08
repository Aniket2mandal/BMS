<div class="mb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name', $bloodbank->name ?? null), ['class' => 'form-control', 'id' => 'name']) !!}
    {{-- Error Message --}}
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<!-- Slug Field (Required) -->
<div class="mb-3">
    {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
    {!! Form::text('slug',old('slug', $bloodbank->slug ?? null), ['class' => 'form-control', 'id' => 'slug']) !!}
    {{-- Error Message --}}
    @error('slug')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<div class="mb-3">
    {!! Form::label('district', 'District', ['class' => 'form-label']) !!}
    {!! Form::select('district', [
        '' => 'Select District',
        'Kathmandu' => 'Kathmandu',
        'Lalitpur' => 'Lalitpur',
        'Bhaktapur' => 'Bhaktapur',
        'Chitwan' => 'Chitwan',
        'Makwanpur' => 'Makwanpur',
        'Pokhara' => 'Pokhara',
        'Kavrepalanchok' => 'Kavrepalanchok',
        'Morang' => 'Morang',
        'Jhapa' => 'Jhapa',
        'Biratnagar' => 'Morang',
        'Damak' => 'Jhapa',
        'Banke' => 'Banke',
        'Rupandehi' => 'Rupandehi',
        'Kailali' => 'Kailali',
        'Dhangadhi' => 'Kailali',
        'Saptari' => 'Saptari',
        'Janakpur' => 'Dhanusha'
    ], old('bloodbank',isset($bloodbank) ? $bloodbank->district:null), ['class' => 'form-control', 'required' => true]) !!}
    {{-- Error Message --}}
    @error('district')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('state', 'Province', ['class' => 'form-label']) !!}
    {!! Form::select('state', [
        '' => 'Select Province',
        'Bagmati' => 'Bagmati',
        'Gandaki' => 'Gandaki',
        'Koshi' => 'Koshi',
        'Lumbini' => 'Lumbini',
        'Sudurpashchim' => 'Sudurpashchim',
        'Madhesh' => 'Madhesh'
    ],  old('bloodbank',isset($bloodbank) ? $bloodbank->state:null), ['class' => 'form-control', 'required' => true]) !!}
    {{-- Error Message --}}
    @error('state')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('city', 'City', ['class' => 'form-label']) !!}
    {!! Form::text('city', old('city', $bloodbank->city ?? null), ['class' => 'form-control', 'id' => 'city']) !!}
    {{-- Error Message --}}
    @error('city')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['class' => 'form-control','onchange'=>'previewImage(event)']) !!}
    {{-- Display Current Image if Available --}}
    @if($bloodbank->image??'')
    <div class="mt-2">
        <img src="{{ asset('images/bloodbank/' . $bloodbank->image) }}" alt="Current Image" class="img-thumbnail" width="150">
    </div>
    @endif
    <!-- Image Preview -->
    <div class="mt-3" id="imagePreviewContainer" style="position: relative; display: none;">
        <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">
    </div>
    {{-- Error Message --}}
    @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
    {!! Form::hidden('status', 0) !!}
    {!! Form::checkbox('status', 1, old('status', $bloodbank->status ?? 0), [
    'id' => 'Status',
    'data-toggle' => 'toggle',
    'data-on' => 'Active',
    'data-off' => 'Inactive',
    'data-onstyle' => 'success',
    'data-offstyle' => 'danger'
    ]) !!}
    <small class="form-text text-muted">Switch to set the status to Active or Inactive</small>
    {{-- Error Message --}}
    @error('status')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', old('description', $bloodbank->description ?? null), ['class' => 'form-control', 'id' => 'description', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>