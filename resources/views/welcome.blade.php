@extends('layouts.front-layout')
@section('content')
    <div id="app">
        <!-- Hero Section Begin -->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-text">
                            <h1>Grandeur Palace</h1>
                            <p>Here are the best hotel booking sites, including recommendations for international
                                travel and for finding low-priced hotel rooms.</p>
                            <a href="#" class="primary-btn">Discover Now</a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                        <home-component />
                    </div>
                </div>
            </div>
            <div class="hero-slider owl-carousel">
                <div class="hs-item set-bg" data-setbg="{{asset('assets/img/hero/hero-5.png')}}"></div>
                <div class="hs-item set-bg" data-setbg="{{asset('assets/img/hero/hero-4.jpeg')}}"></div>
                <div class="hs-item set-bg" data-setbg="{{asset('assets/img/hero/hero-7.jpeg')}}"></div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Services Section End -->
        <section class="services-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>What We Do</span>
                            <h2>Discover Our Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($services as $service)
                        <div class="col-lg-3 col-sm-6">
                            <div class="service-item">
                                <i style="font-size: 40px" class="{{$service->icon_class}}"></i>
                                <h4>{{$service->name}}</h4>
                                <p style="color: #cdcdcd">{{$service->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Services Section End -->

        <!-- Home Room Section Begin -->
        <div class="">
            <slides-component />
        </div>

        <!-- Home Room Section End -->
        <section class="services-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Our</span>
                            <h2>Restaurant</h2>
                        </div>
                    </div>
                </div>
                <section class="hp-room-section">
                    <div class="container-fluid">
                        <div class="hp-services-items">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="hp-services-item set-bg" data-setbg="{{asset('assets/img/restaurant/the-restaurant.jpg')}}">
                                        <div class="hr-text">
                                            <h3>Restaurant</h3>
                                            <a href="{{route('restaurant')}}" class="primary-btn">More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>


        <!-- About Us Section Begin -->
        <section class="aboutus-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-text">
                            <div class="section-title">
                                <span>About Us</span>
                                <h2>Intercontinental LA <br />Westlake Hotel</h2>
                            </div>
                            <p class="f-para">Sona.com is a leading online accommodation site. We’re passionate about
                                travel. Every day, we inspire and reach millions of travelers across 90 local websites in 41
                                languages.</p>
                            <p class="s-para">So when it comes to booking the perfect hotel, vacation rental, resort,
                                apartment, guest house, or tree house, we’ve got you covered.</p>
                            <a href="#" class="primary-btn about-btn">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-pic">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="{{asset('assets/img/about/about-5.jpg')}}" alt="">
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('assets/img/about/about-4.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Section End -->

        <!-- Testimonial Section Begin -->
        <section class="testimonial-section spad">
            <div class="container">
                <reviews-component />
            </div>
        </section>
        <!-- Testimonial Section End -->

        <!-- Contact us Section Begin -->

        <section class="aboutus-section spad">
            <div class="container">
                <contact-component />
            </div>
        </section>


    </div>
@endsection
