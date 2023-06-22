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
                                                <option value="{{ $ameni->amenities_name }}" {{ (in_array($ameni->amenities_name, $property_amenities)) ? 'selected' : '' }}>{{ $ameni->amenities_name }}</option>
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

<!--  /// Multi Image Update //// -->

<div class="page-content" style="margin-top: -35px;" > 

    <div class="row profile-body"> 
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

    <div class="card">
    <div class="card-body">
        <h6 class="card-title"> Edit Multiple Images</h6>

    <form method="post" action="{{ route('update.property.multiImage') }}" id="myForm" enctype="multipart/form-data">
    @csrf

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Image</th>
                    <th>Change Image </th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($multiImage as $key => $img)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td class="py-1">
                            <img src="{{ asset($img->photo_name) }}" alt="image"  style="width:60px; height:60px;">
                        </td> 

                        <td> 
                        <input type="file" class="form-control" name="multi_image[{{ $img->id }}]">
                        </td>

                        <td>
                        <input type="submit" class="btn btn-primary px-4" value="Update Image" >
                        <a href="{{ route('delete.property.multiImage',$img->id) }}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </form> 




    <form method="POST" action="{{ route('store.new.multiImage') }}" id="myForm" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="imageId" value="{{ $property->id }}">

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        <input type="file" class="form-control" name="multi_image">
                    </td>

                    <td>
                        <input type="submit" class="btn btn-info px-4" value="Add Image">
                    </td>
                </tr>
            </tbody>
        </table>


    </form>

        </div>
        </div>

        </div>
    </div>
</div>
</div> 

<!--  /// End Multi Image Update //// -->



{{-- Main thumbnail edit --}}


<div class="page-content" style="margin-top: -35px;">

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Facility</h6>

                            <form method="POST" action="{{ route('update.property.facilities') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $property->id }}">
                            
                            @foreach ($facilities as $item)

                            <div class="row add_item">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                        <div class="container mt-2">
                                            <div class="row">
                                            
                                                <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                        <option value="Hospital" {{ $item->facility_name == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                                                        <option value="SuperMarket" {{ $item->facility_name == 'SuperMarket' ? 'selected' : '' }} >Super Market</option>
                                                        <option value="School" {{ $item->facility_name == 'School' ? 'selected' : '' }} >School</option>
                                                        <option value="Entertainment" {{ $item->facility_name == 'Entertainment' ? 'selected' : '' }} >Entertainment</option>
                                                        <option value="Pharmacy" {{ $item->facility_name == 'Pharmacy' ? 'selected' : '' }} >Pharmacy</option>
                                                        <option value="Airport" {{ $item->facility_name == 'Airport' ? 'selected' : '' }} >Airport</option>
                                                        <option value="Railways" {{ $item->facility_name == 'Railways' ? 'selected' : '' }} >Railways</option>
                                                        <option value="Bus Stop" {{ $item->facility_name == 'Bus Stop' ? 'selected' : '' }} >Bus Stop</option>
                                                        <option value="Beach" {{ $item->facility_name == 'Beach' ? 'selected' : '' }} >Beach</option>
                                                        <option value="Mall" {{ $item->facility_name == 'Mall' ? 'selected' : '' }} >Mall</option>
                                                        <option value="Bank" {{ $item->facility_name == 'Bank' ? 'selected' : '' }} >Bank</option>
                                                </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                <label for="distance">Distance</label>
                                                <input type="text" name="distance[]" id="distance" class="form-control" value="{{ $item->distance }}">
                                                </div>
                                                <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            @endforeach

                            <br><br>
                            
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
                <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div>
                <div class="form-group col-md-4" style="padding-top: 20px">
                <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>      


<!----For Section-------->


<script type="text/javascript">
    $(document).ready(function(){
    var counter = 0;
    $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
    });
    $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
    });
    });
</script>
{{-- End adding multiple facilties --}}

@endsection