<div class="mb-3">
    {!! Form::label('name', 'Blood Group', ['class' => 'form-label']) !!}
    {!! Form::select('name', [
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-'
    ], old('name', $blood->name ?? null), ['class' => 'form-control', 'id' => 'name']) !!}
    
    {{-- Error Message --}}
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


{{-- <div class="mb-3">
    {!! Form::label('quantity', 'Quantity', ['class' => 'form-label']) !!}
    {!! Form::number('quantity', old('quantity',  $quantity ?? null), ['class' => 'form-control', 'id' => 'quantity', 'rows' => 3,]) !!}

    @error('quantity')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div> --}}

<div class="mb-3">
    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', old('description', $blood->description ?? null), ['class' => 'form-control', 'id' => 'description', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
    {!! Form::hidden('status', 0) !!}
    {!! Form::checkbox('status', 1, old('status', $blood->status ?? 0), [
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

{{-- 
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
    {!! Form::select('bloodbank[]', $userBloodBanks->pluck('name','id'), old('bloodbank',isset($blood) ? $userBloodBanks->pluck('id')->toArray() : []), [
        'class' => 'form-control select2',
        'id' => 'Permission',
        'multiple' => 'multiple'
    ]) !!}

    @error('bloodbank')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
@endif --}}
