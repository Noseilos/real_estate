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

                            <h6 class="card-title">Update Amenity</h6>

                            <form id="myForm" method="POST" action="{{ route('update.amenities') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $amenities->id }}">
                                <input type="hidden" name="old_image" value="{{ $amenities->amenities_image }}">

                                <div class="form-group mb-3">
                                    <label for="amenities_name" class="form-label">Amenity Name</label>
                                    <input name="amenities_name" type="text" class="form-control" autocomplete="off"
                                        value="{{ $amenities->amenities_name }}">

                                </div>



                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $amenities->short_desc }}</textarea>

                                    </div>
                                </div><!-- Col -->



                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>

                                        <textarea name="long_desc" class="form-control" name="tinymce" id="tinymceExample" rows="10">{!! $amenities->long_desc !!}</textarea>

                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amenity Photo </label>
                                    <input class="form-control" name="amenities_image" type="file" id="image">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> </label>
                                    <img id="showImage" class="wd-80 rounded-circle"
                                        src="{{ asset($amenities->amenities_image) }}" alt="profile">
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>

    <!--  /// Multi Image Update //// -->

    <div class="page-content" style="margin-top: -35px;">

        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title"> Edit Multiple Images</h6>

                            <form method="post" action="{{ route('update.amenity.multiImage') }}" id="myForm"
                                enctype="multipart/form-data">
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
                                            @foreach ($multiImage as $key => $img)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="py-1">
                                                        <img src="{{ asset($img->photo_name) }}" alt="image"
                                                            style="width:60px; height:60px;">
                                                    </td>

                                                    <td>
                                                        <input type="file" class="form-control"
                                                            name="multi_image[{{ $img->id }}]">
                                                    </td>

                                                    <td>
                                                        <input type="submit" class="btn btn-primary px-4"
                                                            value="Update Image">
                                                        <a href="{{ route('delete.amenity.multiImage', $img->id) }}"
                                                            class="btn btn-danger" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>




                            <form method="POST" action="{{ route('store.new.multiImageAmenity') }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="imageId" value="{{ $amenities->id }}">

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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    amenities_name: {
                        required: true,
                    },

                },
                messages: {
                    amenities_name: {
                        required: 'Please Enter Amenity Name',
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
