@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

    <div class="row profile-body">
      <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Property</h6>

                        <form method="POST" action="{{ route('update.property') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $property->id }}">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name</label>
                                        <input type="text" name="property_name" class="form-control" value="{{ $property->property_name }}">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status</label>
                                        <select name="property_status" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Select Status</option>
											<option value="rent" {{ $property->property_status == 'rent' ? 'selected' : '' }}>For Rent</option>
											<option value="buy" {{ $property->property_status == 'buy' ? 'selected' : '' }}>For Sale</option>
										</select>
                                    </div>
                                </div><!-- Col -->


                                
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price</label>
                                        <input type="text" name="lowest_price" class="form-control" value="{{ $property->lowest_price }}">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Maximum Price</label>
                                        <input type="text" name="max_price" class="form-control" value="{{ $property->max_price }}">
                                    </div>
                                </div><!-- Col -->

                            </div><!-- Row -->



                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bedrooms</label>
                                        <input type="text" class="form-control" name="bedrooms" value="{{ $property->bedrooms }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bathrooms</label>
                                        <input type="text" class="form-control" name="bathrooms" value="{{ $property->bathrooms }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage</label>
                                        <input type="text" class="form-control" name="garage" value="{{ $property->garage }}">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" class="form-control" name="garage_size" value="{{ $property->garage_size }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->




                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $property->address }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city" value="{{ $property->city }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" name="state" value="{{ $property->state }}">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{ $property->postal_code }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->




                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" class="form-control" name="property_size" value="{{ $property->property_size }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" class="form-control" name="property_video" value="{{ $property->property_video }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" class="form-control" name="neighborhood" value="{{ $property->neighborhood }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->




                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="latitude" value="{{ $property->latitude }}">
                                        <a href="https://www.latlong.net/" target="_blank">Get Address Latitude</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" value="{{ $property->longitude }}">
                                        <a href="https://www.latlong.net/" target="_blank">Get Address Longitude</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->




                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type</label>
                                        <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Select Type</option>

                                            @foreach($propertyType as $pType)
											    <option value="{{ $pType->id }}" {{ $pType->id == $property->ptype_id ? 'selected' : '' }}>{{ $pType->type_name }}</option>
                                            @endforeach
										</select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">

                                            @foreach($amenities as $ameni)
                                                <option value="{{ $ameni->id }}" {{ (in_array($ameni->id, $property_amenities)) ? 'selected' : '' }}>{{ $ameni->amenities_name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent</label>
                                        <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Select Agent</option>

                                            @foreach ($activeAgent as $agent)
											    <option value="{{ $agent->id }}" {{ $agent->id == $property->agent_id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                            @endforeach
										</select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $property->short_desc }}
                                        </textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea name="long_desc" class="form-control" name="tinymce" id="tinymceExample" rows="10">{!! $property->long_desc !!}
                                        </textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="featured" value="1" id="checkInline1" {{ $property->featured == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline1">
                                            Featured Property
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="hot" value="1" id="checkInline" {{ $property->hot == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline">
                                            Hot Property
                                        </label>
                                    </div>
                                </div>

                            </div><!-- Row -->

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



{{-- Main thumbnail edit --}}


<div class="page-content" style="margin-top: -35px;">

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Thumbnail and Images</h6>

                            <form method="POST" action="{{ route('update.property.thumbnail') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                                
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <input type="hidden" name="old_image" value="{{ $property->property_thumbnail }}">

                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Main Thumbnail</label>
                                        <input type="file" name="property_thumbnail" class="form-control" onchange="mainThumUrl(this)">
                                        <img src="" id="mainThumbnail">
                                    </div>

                                    
                                    <div class="form-group col-md-6">
                                        <label class="form-label"></label>
                                        <img src="{{ asset($property->property_thumbnail) }}" alt="thumbnail" style="width: 100px; height: 100px;">
                                    </div>
                                </div><!-- Col -->

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- End Main thumbnail edit --}}





<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                property_name: {
                    required : true,
                }, 
                property_status: {
                    required : true,
                }, 
                lowest_price: {
                    required : true,
                }, 
                max_price: {
                    required : true,
                }, 
                ptype_id: {
                    required : true,
                }, 
                
            },
            messages :{
                property_name: {
                    required : 'Please Enter Property Name',
                }, 
                property_status: {
                    required : 'Please Select Property Status',
                }, 
                lowest_price: {
                    required : 'Please Enter Lowest Price',
                }, 
                max_price: {
                    required : 'Please Enter Maximum Price',
                }, 
                ptype_id: {
                    required : 'Please Enter Property Type',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

<script type="text/javascript">

    function mainThumUrl(input){

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumbnail').attr('src', e.target.result).width(80).height(80);
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

</script>

<script> 
 
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
</script>

@endsection