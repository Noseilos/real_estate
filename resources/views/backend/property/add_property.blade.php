@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Property</h6>

                            <form method="POST" action="{{ route('store.property') }}" id="propertyForm"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select name="property_status" class="form-select"
                                                id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Status</option>
                                                <option value="rent">For Rent</option>
                                                <option value="buy">For Sale</option>
                                            </select>
                                        </div>
                                    </div><!-- Col -->



                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Lowest Price</label>
                                            <input type="text" name="lowest_price" class="form-control">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Maximum Price</label>
                                            <input type="text" name="max_price" class="form-control">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Main Thumbnail</label>
                                            <input type="file" name="property_thumbnail" class="form-control"
                                                onchange="mainThumUrl(this)">
                                            <img src="" id="mainThumbnail">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Multiple Images</label>
                                            <input type="file" name="multi_images[]" id="multiImg" multiple=""
                                                class="form-control">

                                            <div class="row" id="preview_img">

                                            </div>
                                        </div>
                                    </div><!-- Col -->

                                </div><!-- Row -->



                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <input type="text" class="form-control" name="bedrooms">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" class="form-control" name="bathrooms">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" class="form-control" name="garage">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage Size</label>
                                            <input type="text" class="form-control" name="garage_size">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->




                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">State</label>
                                            <select name="state" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select State</option>
                                                @foreach ($pstate as $state)
                                                    <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->




                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" class="form-control" name="property_size">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" class="form-control" name="property_video">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Neighborhood</label>
                                            <input type="text" class="form-control" name="neighborhood">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->




                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" class="form-control" name="latitude">
                                            <a href="https://www.latlong.net/" target="_blank">Get Address Latitude</a>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" class="form-control" name="longitude">
                                            <a href="https://www.latlong.net/" target="_blank">Get Address Longitude</a>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->




                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Type</option>

                                                @foreach ($propertyType as $pType)
                                                    <option value="{{ $pType->id }}">{{ $pType->type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Amenities</label>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                                multiple="multiple" data-width="100%">

                                                @foreach ($amenities as $ameni)
                                                    <option value="{{ $ameni->id }}">{{ $ameni->amenities_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Agent</label>
                                            <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Agent</option>

                                                @foreach ($activeAgent as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="short_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Long Description</label>
                                            <textarea name="long_desc" class="form-control" name="tinymce" id="tinymceExample" rows="10"></textarea>
                                        </div>
                                    </div><!-- Col -->

                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="featured"
                                                value="1" id="checkInline1">
                                            <label class="form-check-label" for="checkInline1">
                                                Featured Property
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="hot"
                                                value="1" id="checkInline">
                                            <label class="form-check-label" for="checkInline">
                                                Hot Property
                                            </label>
                                        </div>
                                    </div>

                                </div><!-- Row -->


                                {{-- FACILITIES --}}



                                <div class="row add_item">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="facility_name" class="form-label">Facilities </label>
                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                <option value="">Select Facility</option>
                                                <option value="Hospital">Hospital</option>
                                                <option value="SuperMarket">Super Market</option>
                                                <option value="School">School</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                                <option value="Airport">Airport</option>
                                                <option value="Railways">Railways</option>
                                                <option value="Bus Stop">Bus Stop</option>
                                                <option value="Beach">Beach</option>
                                                <option value="Mall">Mall</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="distance" class="form-label"> Distance </label>
                                            <input type="text" name="distance[]" id="distance" class="form-control"
                                                placeholder="Distance (Km)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="padding-top: 30px;">
                                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                            More..</a>
                                    </div>
                                </div> <!---end row-->


                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <!-- right wrapper end -->
        </div>

    </div>

    {{-- // Start Form Validation //  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#propertyForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    lowest_price: {
                        required: true,
                        number: true,
                    },
                    max_price: {
                        required: true,
                        number: true,
                    },
                    property_thumbnail: {
                        required: true,
                    },
                    ptype_id: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    postal_code: {
                        required: true,
                        number: true,
                    },
                    agent_id: {
                        required: true,
                    },
                },
                messages: {
                    property_name: {
                        required: 'Please Enter Property Name',
                    },
                    property_status: {
                        required: 'Please Select Property Status',
                    },
                    lowest_price: {
                        required: 'Please Enter Lowest Price',
                    },
                    max_price: {
                        required: 'Please Enter Maximum Price',
                    },
                    property_thumbnail: {
                        required: 'Please Select Property Thumbnail',
                    },
                    ptype_id: {
                        required: 'Please Enter Property Type',
                    },
                    address: {
                        required: 'Please Enter an Address',
                    },
                    city: {
                        required: 'Please Enter a City',
                    },
                    state: {
                        required: 'Please Select a State',
                    },
                    postal_code: {
                        required: 'Please Enter a Postal Code',
                    },
                    agent_id: {
                        required: 'Please Select Agent',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    {{-- // End Form Validation //  --}}

    {{-- // Start Main Thumbnail //  --}}
    <script type="text/javascript">
        function mainThumUrl(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumbnail').attr('src', e.target.result).width(80).height(80);
                };

                reader.readAsDataURL(input.files[0]);

            }
        }
    </script>
    {{-- // End Main Thumbnail //  --}}

    {{-- // Start Multiple Image //  --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                            .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                    img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
    {{-- // End Multiple Image //  --}}

    {{-- Adding multiple facilities with Ajax --}}
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="facility_name">Facilities</label>
                            <select name="facility_name[]" id="facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Hospital">Hospital</option>
                                <option value="SuperMarket">Super Market</option>
                                <option value="School">School</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Airport">Airport</option>
                                <option value="Railways">Railways</option>
                                <option value="Bus Stop">Bus Stop</option>
                                <option value="Beach">Beach</option>
                                <option value="Mall">Mall</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance[]" id="distance" class="form-control"
                                placeholder="Distance (Km)">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->


    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    {{-- End adding multiple facilties --}}
@endsection
