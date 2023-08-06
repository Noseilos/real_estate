@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add State </h6>

                            <form id="stateForm" method="POST" action="{{ route('store.state') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">State Name </label>
                                    <input type="text" name="state_name" class="form-control ">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">State Photo </label>
                                    <input class="form-control" name="state_image" type="file" id="image">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Multiple Images</label>
                                    <input type="file" name="multi_images[]" id="multiImg" multiple=""
                                        class="form-control">
                                    <div class="row" id="preview_img">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> </label>
                                    <img id="showImage" class="wd-80 rounded-circle" src="{{ url('upload/no_image.jpg') }}"
                                        alt="profile">
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Save Changes </button>

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
            $('#stateForm').validate({
                rules: {
                    state_name: {
                        required: true,
                        minlength: 5
                    },
                    state_image: {
                        required: true,
                    },
                },
                messages: {
                    state_name: {
                        required: 'Please Enter State Name',
                        minlength: 'State name must consist of at least 5 characters.',
                    },
                    state_image: {
                        required: 'Please Choose State Image',
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
@endsection
