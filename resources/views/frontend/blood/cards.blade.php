@foreach ($blood as $bloods)
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-body">
                <small class="text-muted">Updated on Jun 4, 2025, 9:31:37 AM</small>
                @foreach ($bloods->bloodBanks as $bloodBank)
                    <h6 class="card-title mt-2 text-danger">
                        {{ $bloodBank->name }}
                        <span class="badge bg-light text-danger border border-danger ms-1">Govt.</span>
                    </h6>
                @endforeach
                <div class="my-2">
                    <span class="badge rounded-pill bg-danger-subtle text-danger">AB+Ve (1)</span>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-danger btn-sm">Details</button>
                    <button class="btn btn-sm text-white" style="background-color: #2e4a5b;">
                        ✈️ 8771.03 kms
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
