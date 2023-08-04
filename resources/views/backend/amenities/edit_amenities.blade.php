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
