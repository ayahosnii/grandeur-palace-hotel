@extends('layouts.front-layout')
@section('content')
    <div id="app">
        <!-- Breadcrumb Section Begin -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>About Us</h2>
                            <div class="bt-option">
                                <a href="./index.html">Home</a>
                                <span>About Us</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- About Us Page Section Begin -->
        <section class="aboutus-page-section spad">
            <div class="container">
                <div class="about-page-text">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ap-title">
                                <h3>Welcome To Grandeur Palace.</h3>
                                <p>Built in 1910 during the Belle Epoque period, this hotel is located in the center of
                                    Paris, with easy access to the city’s tourist attractions. It offers tastefully
                                    decorated rooms.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <ul class="ap-services">
                                <li><i class="icon_check"></i> 20% Off On Accommodation.</li>
                                <li><i class="icon_check"></i> Complimentary Daily Breakfast</li>
                                <li><i class="icon_check"></i> 3 Pcs Laundry Per Day</li>
                                <li><i class="icon_check"></i> Free Wifi.</li>
                                <li><i class="icon_check"></i> Discount 20% On F&B</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="about-page-services">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80">
                                <div class="api-text">
                                    <h3>Restaurants Services</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="https://images.unsplash.com/photo-1530065928592-fb0dc85d2f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80">
                                <div class="api-text">
                                    <h3>Travel & Camping</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80">
                                <div class="api-text">
                                    <h3>Event & Party</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Page Section End -->

        <!-- Video Section Begin -->
        <section class="video-section set-bg" data-setbg="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video-text">
                            <h2>Discover Our Hotel & Services.</h2>
                            <p>It S Hurricane Season But We Are Visiting Hilton Head Island</p>
                            <a href="https://www.youtube.com/watch?v=2oyvVhq48OA" class="play-btn video-popup"><img
                                    src="{{asset('assets/img/play.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Video Section End -->

        <galary-component></galary-component>
    </div>
@endsection
