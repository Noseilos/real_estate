@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Property Category Tahanan RealEstate
@endsection


<!-- category-section -->
<section class="category-section centred category-page centred mr-0 pt-120 pb-90">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach ($property_type as $category)
                    @php
                        $property = App\Models\Property::where('ptype_id', $category->id)
                            ->where('status', '1')
                            ->get();
                    @endphp

                    <li>
                        <div class="category-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $category->type_icon }}"></i></div>
                                <h5><a href="{{ route('property.type', $category->id) }}">{{ $category->type_name }}</a>
                                </h5>
                                <span>{{ count($property) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- category-section end -->


@endsection
