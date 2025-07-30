@extends('frontend.layout.index')

@section('content')
<!-- About Page Hero -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-start d-flex">
            <!-- Left side: Image and Text -->
            <div class="col-md-7 mb-4 mb-md-0">
                <img src="{{ asset('images/Front/mainimage.jpg') }}" alt="About" class="img-fluid rounded shadow">
                <div class="mt-4">
                    <h2 style="color: #b30000;">Who We Are</h2>
                    <p class="text-muted">
                        We are a dedicated team working to bridge the gap between blood donors and those in urgent need.
                        With a vision for a healthier tomorrow, we organize camps, raise awareness, and create a reliable network for voluntary blood donation.
                    </p>
                    <p class="text-muted">
                        Every drop counts. Every donor is a hero.
                    </p>

                    <h4 class="mt-4" style="color: #b30000;">Our Mission</h4>
                    <p class="text-muted">
                        Our mission is to ensure timely and safe access to blood for every individual in need. We believe in empowering communities through awareness, education, and action. By collaborating with local hospitals and healthcare providers, we aim to build a stronger, more resilient healthcare system.
                    </p>
            
                    <h4 class="mt-4" style="color: #b30000;">Our Impact</h4>
                    <ul class="text-muted ps-3">
                        <li>Over 10,000 units of blood collected and distributed.</li>
                        <li>More than 200 donation camps organized annually.</li>
                        <li>Strong partnerships with hospitals and health centers nationwide.</li>
                        <li>Thousands of lives saved through timely interventions.</li>
                    </ul>
            
                    <h4 class="mt-4" style="color: #b30000;">Join Us</h4>
                    <p class="text-muted">
                        Whether you're a first-time donor or a regular supporter, there's a place for you in our mission. Together, we can make a life-saving difference.
                    </p>
                    <a href="#" class="btn btn-danger mt-2">Become a Donor</a>
                    <a href="#" class="btn btn-outline-danger mt-2 ms-2">Volunteer With Us</a>
                </div>
            </div>

            <!-- Right side: Image card -->
            <div class="col-md-5 d-flex">
                <div class="card shadow border-0 flex-fill">
                    <img src="{{ asset('images/Front/mainimage.jpg') }}" class="card-img-top" alt="Awareness">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Did You Know?</h5>
                        <p class="card-text">
                            A single donation can save up to 3 lives. Regular donations help maintain critical supply levels in hospitals.
                        </p>
                        <a href="#" class="btn btn-danger">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
