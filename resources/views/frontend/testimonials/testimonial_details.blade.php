@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Testimonials | Tahanan Real Estate
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
            <h1> Testimonial: {{ $testimonial->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Testimonial: {{ $testimonial->name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<section class="property-details property-details-one" style="margin-top: -80px; margin-bottom: -100px">
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
    </div>
</section>
<!-- testimonial-style-two -->
<section class="testimonial-style-two bg-color-1 centered" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png')}});">
    <div class="auto-container">
        <div class="row clearfix">
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-18"></i></div>
                            <div class="text">
                                <h3>{{ $testimonial->message }}</h3>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb"><img src="{{ asset($testimonial->image) }}" alt=""></figure>
                                <h4>{{ $testimonial->name }}</h4>
                                <span class="designation">{{ $testimonial->position }}</span>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</section>
<!-- testimonial-style-two end -->

@endsection
