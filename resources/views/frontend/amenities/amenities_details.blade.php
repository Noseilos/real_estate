@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    {{ $amenities->amenities_name }} | Tahanan Real Estate
@endsection


<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1> {{ $amenities->amenities_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>{{ $amenities->amenities_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

                            @foreach ($multiImage as $image)
                                <figure class="image-box"><img src="{{ asset($image->photo_name) }}" alt="">
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($amenities->amenities_image) }}" alt="">
                                </figure>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <h3>{{ $amenities->amenities_name }}</h3>
                                <ul class="post-info clearfix">
                                    <li>{{ $amenities->created_at->format('M d Y') }}</li>
                                </ul>
                                <div class="text">
                                    <p> {!! $amenities->long_desc !!} </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

@endsection
