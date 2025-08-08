
            
          
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
                    {!! Form::text('name', old('name', $role->name ?? null), ['class' => 'form-control', 'id' => 'Name']) !!}
                    {{-- Error Message --}}
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Slug', 'Slug', ['class' => 'form-label']) !!}
                    {!! Form::text('slug',old('slug', $role->slug ?? null), ['class' => 'form-control', 'id' => 'Slug']) !!}
                    {{-- Error Message --}}
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions Field -->
                <div class="mb-3">
                    {!! Form::label('Permission', 'Select Permissions', ['class' => 'form-label']) !!}
                    {!! Form::select('permission[]', $permissions->pluck('name', 'id')->toArray(),   old('permission', isset($role) ? $role->permissions->pluck('id')->toArray() : []), ['class' => 'form-control select2', 'id' => 'Permission', 'multiple' => 'multiple']) !!}
                    {{-- Error Message --}}
                    @error('permission')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>