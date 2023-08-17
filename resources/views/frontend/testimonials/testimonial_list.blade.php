@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Testimonials | Tahanan RealEstate
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
            <h1> Testimonials </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Testimonials </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

        <section class="testimonial-style-four centred sec-pad-2">
            <div class="auto-container">
                <div class="row clearfix">
                    @foreach ($testimonial as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-column">
                            <div class="testimonial-block-three">
                                <div class="inner-box">
                                    <figure class="thumb-box"><img src="{{ asset($item->image) }}" alt=""></figure>
                                    <h4>{{ substr($item->message, 0, 95) }}... </h4>
                                    <h5>{{ $item->name }}</h5>
                                    <span class="designation">{{ $item->position }}</span>
                                    <br>
                                    <div class="btn-box">
                                        <a href="{{ url('testimonial/details/'.$item->id) }}"
                                            class="theme-btn btn-two">See Details</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                
            </div>
            
        </section>



@endsection