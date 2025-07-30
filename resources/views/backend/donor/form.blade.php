<div class="mb-3">
    {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name', isset($donor)?$donor->name : null), ['class' => 'form-control', 'id' => 'name']) !!}
    @error('Name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('Email', 'Email', ['class' => 'form-label']) !!}
    {!! Form::email('email', old('email', isset($donor)?$donor->email : null), ['class' => 'form-control', 'id' => 'email']) !!}
    @error('Email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 position-relative">
    {!! Form::label('Password','Password',['class'=>'form-label']) !!}
    
    <div class="input-group">
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', isset($donor) ? 'disabled' : null]) !!}
        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
            <i class="fa fa-eye" id="toggle-icon"></i>
        </span>
    </div>

    @error('Password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address" class="form-control " id="address" value="{{ old('address', isset($donor)?$donor->address :null) }}">
  
    @error('address')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control " id="phone" value="{{ old('address', isset($donor)?$donor->phone : null) }}">
    {{-- Error Message --}}
    @error('phone')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<div class="mb-3">
    <label for="allergies">Do you have any of the following allergies?</label>
    <select name="allergies[]" id="Permission" class = 'form-control select2' multiple>
        <option value="none">None</option>
        <option value="pollen">Pollen (Seasonal)</option>
        <option value="dust">Dust</option>
        <option value="pet_dander">Pet Dander</option>
        <option value="food_peanuts">Food – Peanuts</option>
        <option value="food_shellfish">Food – Shellfish</option>
        <option value="food_eggs">Food – Eggs</option>
        <option value="medications">Medications (e.g., antibiotics)</option>
        <option value="latex">Latex</option>
        <option value="insect_stings">Insect Stings (e.g., bees)</option>
        <option value="transfusion">Previous Blood Transfusion Reaction</option>
        <option value="autoimmune">Autoimmune or Blood-related Allergy</option>
        <option value="other">Other (please specify)</option>
    </select>

    <!-- Optional text field for 'Other' -->
    {{-- <input type="text" name="other_allergy_details" placeholder="Specify other allergy"> --}}
    {{-- Error Message --}}
    @error('allergies')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('Status', 'Status:', ['class' => 'form-label']) !!}

    {!! Form::hidden('status', 0) !!}
    {!! Form::checkbox('status', 1, old('status', isset($donor)?$donor->status : 0), [
        'id' => 'status',
        'data-toggle' => 'toggle',
        'data-on' => 'Active',
        'data-off' => 'Inactive',
        'data-onstyle' => 'success',
        'data-offstyle' => 'danger',
    ]) !!}
    <small class="form-text text-muted">Switch to set the status to active or inactive</small>

    @error('Status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('name', 'Blood Group', ['class' => 'form-label']) !!}
    {!! Form::select(
        'bloodgroup',
        [
            'A+' => 'A+',
            'A-' => 'A-',
            'B+' => 'B+',
            'B-' => 'B-',
            'AB+' => 'AB+',
            'AB-' => 'AB-',
            'O+' => 'O+',
            'O-' => 'O-',
        ],
        old('bloodgroup',isset($donor)?$donor->blood : null),
        ['class' => 'form-control', 'id' => 'name'],
    ) !!}

<div class="mb-3">
    <label for="phone" class="form-label">Quantity</label>
    <input type="number" name="quantity" class="form-control " id="quantity" value="{{ old('quantity', isset($donor)?$donor->quantity_donated : null) }}" min="0" step="0.01" >
    {{-- Error Message --}}
    @error('quantity')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


    <div class="mb-3">
        {!! Form::label('bloodbank', 'Blood Banks', ['class' => 'form-label']) !!}
        {!! Form::select(
            'bloodbank',
            $bloodbank->pluck('name','id'),
            old('bloodbank', isset($donor) && $donor->bloodBanks->first() ? $donor->bloodBanks->first()->id : null),
            [
                'class' => 'form-control select2',
                'id' => 'Permission',
                isset($donor) ? 'disabled' : null
            ],
        ) !!}

        {{-- Error Message --}}
        @error('bloodbank')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label for ="date" class="form-label">Date</label>
        <input type="date" name="date" class="form-control " id="date" value="{{ old('date', isset($donor)?$donor->donation_date : null) }}">
        {{-- Optional text field for 'Other' --}}
        {{-- <input type="text" name="other_allergy_details" placeholder="Specify other allergy"> --}}
        <small class="form-text text-muted">Select the date of donation</small>
        {{-- Error Message --}}
        @error('bloodbank')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>




    {{-- <div class="mb-3">
    <label for="Image" class="form-label">Profile Image</label>
    <input type="file" name="image" class="form-control" id="Image" onchange="previewImage(event)">
    <!-- Image Preview -->
    <div class="mt-3" id="imagePreviewContainer" style="display: none;">
        <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">
    </div>

    @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div> --}}


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>