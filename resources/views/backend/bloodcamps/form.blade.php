<div class="mb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name',isset($camps)?$camps->name:null), ['class' => 'form-control', 'id' => 'name']) !!}
    {{-- Error Message --}}
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<!-- Slug Field (Required) -->

<div class="mb-3">
    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
    {!! Form::text('address', old('address',isset($camps)?$camps->address:null), ['class' => 'form-control', 'id' => 'address', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('address')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['class' => 'form-control','onchange'=>'previewImage(event)']) !!}
    {{-- Display Current Image if Available --}}
    @if($camps->image??'')
    <div class="mt-2">
        <img src="{{ asset('images/camps/'.$camps->image) }}" alt="Current Image" class="img-thumbnail" width="150">
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
    {!! Form::checkbox('status', 1, old('status',isset($camps)?$camps->status:0), [
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
    {!! Form::textarea('description', old('description',isset($camps)?$camps->description:null), ['class' => 'form-control', 'id' => 'description', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@if(auth()->user() && auth()->user()->hasRole('Admin'))
<div class="mb-3">
    {!! Form::label('bloodbank', 'Blood Banks', ['class' => 'form-label']) !!}
    {!! Form::select('bloodbank[]', $bloodbank->pluck('name','id'), old('bloodbank',isset($blood) ? $blood->bloodBanks->pluck('id')->toArray() : []), [
        'class' => 'form-control select2',
        'id' => 'Permission',
        'multiple' => 'multiple'
    ]) !!}

    @error('bloodbank')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@else
<div class="mb-3">
    {!! Form::label('bloodbank', 'Blood Banks', ['class' => 'form-label']) !!}
    {!! Form::select('bloodbank', $userBloodBanks->pluck('name','id'), old('bloodbank',isset($blood) ? $userBloodBanks->pluck('id'): null), [
        'class' => 'form-control',
        'id' => 'bloodbank',
    ]) !!}

    @error('bloodbank')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@endif

<div class="mb-3">
    {!! Form::label('date','Date',['class'=>'form-label']) !!}
    {!! Form::date('date',old('date',isset($camps)?$camps->date:null),['class'=>'form-control','id'=>'campdate','rows'=>3]) !!}
    {{-- Error Message --}}
    @error('date')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('time','Time',['class'=>'form-label']) !!}
    {!! Form::time('time',old('time',isset($camps)?$camps->time:null),['class'=>'form-control','id'=>'camptime','rows'=>3]) !!}
    {{-- Error Message --}}
    @error('time')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>