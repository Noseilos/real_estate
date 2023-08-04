@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Amenity | Tahanan RealEstate
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
            <h1> Amenity </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Amenity </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="blog-list sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">

            @foreach ($amenities as $item)
                <div class="col-lg-6 col-md-12 col-sm-12 news-block">
                    <div class="news-block-two wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box align-items-center">
                            <div class="image-box">
                                <figure class="image"><a href="blog-details.html"><img src="{{ asset($item->amenities_image) }}" alt=""></a></figure>
                            </div>
                            <div class="content-box">
                                <h4><a href="blog-details.html">{{ $item->amenities_name }}</a></h4>
                                <p>{{ $item->short_desc }}</p>
                                <div class="btn-box">
                                    <a href="blog-details.html" class="theme-btn btn-two">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="pagination-wrapper">
            <ul class="pagination clearfix">
                <li><a href="blog-2.html" class="current">1</a></li>
                <li><a href="blog-2.html">2</a></li>
                <li><a href="blog-2.html">3</a></li>
                <li><a href="blog-2.html"><i class="fas fa-angle-right"></i></a></li>
            </ul>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

@endsection
