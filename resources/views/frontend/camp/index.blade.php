@extends('frontend.layout.index')

@section('content')
<div class="bg-danger text-white p-3 d-flex align-items-center">

    <div>
        <h4 class="mb-0">Blood Management System</h4>
        <small>Ministry of Health and Family Welfare</small>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Top colored header strip -->
        <div class="px-4 py-2" style="background: linear-gradient(90deg, #2E4A5B, #16323E); color: #fff;">
            <h2 class="mb-0 fw-bold">🩸 {{ $camp->name }}</h2>
        </div>

        <div class="row g-0">
            <!-- Left Image Section -->
            <div class="col-md-5">
                @if($camp->image)
                    <img src="{{ asset('images/camps/' . $camp->image) }}" class="img-fluid h-100 w-100 object-fit-cover" alt="{{ $camp->name }}">
                @else
                    <img src="{{ asset('images/default-camp.jpg') }}" class="img-fluid h-100 w-100 object-fit-cover" alt="No image">
                @endif
            </div>

            <!-- Right Details Section -->
            <div class="col-md-7 bg-light p-5">
                <!-- Info List -->
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <span class="me-2 text-danger fs-5">📍</span>
                        <div>
                            <strong class="text-dark">Address:</strong> {{ $camp->address }}
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="me-2 text-danger fs-5">📅</span>
                        <div>
                            <strong class="text-dark">Date:</strong> {{ \Carbon\Carbon::parse($camp->date)->format('F j, Y') }}
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="me-2 text-danger fs-5">⏰</span>
                        <div>
                            <strong class="text-dark">Time:</strong> {{ \Carbon\Carbon::parse($camp->time)->format('h:i A') }}
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="me-2 text-danger fs-5">🏥</span>
                        <div>
                            <strong class="text-dark">Organized by:</strong> {{ $camp->bloodBanks->pluck('name')->join(', ') }}
                        </div>
                    </li>
                </ul>

                <hr class="text-muted">

                <div class="mb-4">
                    <h5 class="fw-bold text-danger mb-2">📝 Description</h5>
                    <p class="text-secondary">{!! $camp->description !!}</p>
                </div>

                <!-- CTA Button -->
                <a href="{{ route('frontdashboard.index') }}" class="btn btn-outline-danger">
                    ⬅ Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
