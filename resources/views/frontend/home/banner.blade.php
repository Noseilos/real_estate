@php
$states = App\Models\State::latest()->get();
$ptypes = App\Models\PropertyType::latest()->get();
@endphp

<style>
    .form-group {
        position: relative;
    }

    .form-group .field-input {
        position: relative;
    }

    .form-group .field-input i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 20px;
    }

    .form-group .form-control {
        padding-left: 40px; 
    }

    .tt-menu {
        background-color: #ffffff;
        border: 1px solid #ccc;
        position: absolute;
        width: 100%; 
        top: 100%;
        z-index: 1000;
    }

    .tt-dataset {
        padding: 5px; 
        cursor: pointer;
    }
</style>

<section class="banner-section" style="background-image: url({{ asset('frontend/assets/images/banner/landscape-bg.jpg')}});">
    <div class="auto-container">
        <div class="inner-container">
            <div class="content-box centred">
                <h2>Bumili ng Tirahan, Bumuo ng Tahanan</h2>
                <p>We're here to make your home buying or selling experience as smooth as possible.</p>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">BUY</li>
                            <li class="tab-btn" data-tab="#tab-2">RENT</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">

                                    <form action="{{ route('buy.property.search') }}" method="post" class="search-form">
                                        @csrf 

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="text" id="search" name="search" placeholder="Search" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select id="locationSelect" name="state" class="wide">
                                                            <option value="">Input location</option>
                                                            @foreach($states as $state)
                                                                <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select id="propertyTypeSelect" name="ptype_id" class="wide">
                                                            <option value="">All Type</option>
                                                            @foreach($ptypes as $type)
                                                                <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <div class="top-search">

                                    <form action="{{ route('rent.property.search') }}" method="post" class="search-form">
                                        @csrf 

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input" >
                                                        <i class="fas fa-search"></i>
                                                        <input type="text" id="search" name="search" placeholder="Search" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select id="locationSelect" name="state" class="wide">
                                                            <option value="">Input location</option>
                                                            @foreach($states as $state)
                                                                <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select id="propertyTypeSelect" name="ptype_id" class="wide">
                                                            <option value="">All Type</option>
                                                            @foreach($ptypes as $type)
                                                                <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js"></script>

    <script type="text/javascript">
        $('#search').typeahead({
            minLength: 1,
            highlight: true
        }, {
            source: function (query, syncResults, asyncResults) {
                $.ajax({
                    url: "{{ route('autocomplete-search') }}",
                    data: { query: query },
                    success: function (data) {
                        asyncResults(data);
                    }
                });
            },
            name: 'propertiesList',
            displayKey: 'property_name'
        });
    </script>
</section>