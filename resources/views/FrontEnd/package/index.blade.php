@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <section style="margin:20px;">
        <div class="card">
            <div class="card-body">

                <div class="container">
                    <div class="pricing-table">
                        <h6 class="mb-0 text-uppercase">Our Package</h6>
                        <hr />
                        <div class="row row-cols-1 row-cols-lg-3">


                            @foreach($packages as $package)
                            <div class="col">
                                <div class="card mb-5 mb-lg-0">
                                    <div class="card-header bg-{{ $package->background_color }} py-3">
                                        <h5 class="card-title text-white text-uppercase text-center">
                                            {{ $package->package_name }}</h5>
                                        <h6 class="card-price text-white text-center">${{ $package->price }}
                                            <!-- <span class="term">/month</span> -->
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <i class='fa-solid fa-check font-18'
                                                    style="margin-right:5px;"></i>{{ $package->post_number }}
                                                Number
                                                Of Post
                                            </li>
                                            <li class="list-group-item"><i class='fa-solid fa-check font-18'
                                                    style="margin-right:5px;"></i>{{ $package->image_number }}
                                                Number
                                                of Image Per
                                                Post
                                            </li>
                                            <li class="list-group-item"><i class='fa-solid fa-check font-18'
                                                    style="margin-right:5px;"></i>{{ $package->publish_day }}
                                                Nmuber
                                                of Day
                                                Publish</li>

                                        </ul>
                                        <div class="d-grid">
                                            <a href="#" class="btn btn-{{ $package->background_color }} my-2 radius-30">Order
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Plus Tier -->
                            <!--                          <div class="col">
                                <div class="card mb-5 mb-lg-0">
                                    <div class="card-header bg-primary py-3">
                                        <h5 class="card-title text-white text-uppercase text-center">Plus</h5>
                                        <h6 class="card-price text-white text-center">$9<span class="term">/month</span>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Single
                                                User</li>
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>5GB
                                                Storage</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Unlimited Public Projects</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Community Access</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Unlimited Private Projects</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Dedicated Phone Support</li>
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Free
                                                Subdomain</li>
                                            <li class="list-group-item text-secondary"><i
                                                    class='bx bx-x me-2 font-18'></i>Monthly Status Reports</li>
                                        </ul>
                                        <div class="d-grid"> <a href="#" class="btn btn-primary my-2 radius-30">Order
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Pro Tier -->
                            <!--      <div class="col">
                                <div class="card">
                                    <div class="card-header bg-warning py-3">
                                        <h5 class="card-title text-dark text-uppercase text-center">Pro</h5>
                                        <h6 class="card-price text-center">$49<span class="term">/month</span></h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Single
                                                User</li>
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>5GB
                                                Storage</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Unlimited Public Projects</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Community Access</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Unlimited Private Projects</li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>Dedicated Phone Support</li>
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Free
                                                Subdomain</li>
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Monthly
                                                Status Reports</li>
                                        </ul>
                                        <div class="d-grid"> <a href="#" class="btn btn-warning my-2 radius-30">Order
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection