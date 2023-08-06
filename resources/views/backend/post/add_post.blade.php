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

                            <h6 class="card-title">Add Post </h6>

                            <form id="postForm" method="POST" action="{{ route('store.post') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Post Title </label>
                                            <input type="text" name="post_title" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Blog Category </label>
                                            <select name="blogcat_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Category</option>
                                                @foreach ($blogcat as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                                    </div>
                                </div><!-- Col -->



                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10"></textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Post Tags </label>
                                        <input name="post_tags" id="tags" value="Realestate," />
                                    </div>
                                </div><!-- Col -->



                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Wallpaper</label>
                                        <input name="post_image" class="form-control"  type="file" id="image">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Multiple Images</label>
                                        <input type="file" name="multi_images[]" id="multiImg" multiple=""
                                            class="form-control">
                                        <div class="row" id="preview_img">
                                        </div>
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
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
    $(document).ready(function (){
        $('#postForm').validate({
            rules: {
                post_title: {
                    required : true,
                    minlength: 5
                }, 
                blogcat_id: {
                    required : true,
                }, 
                short_descp: {
                    required : true,
                }, 
                post_image: {
                    required : true,
                }, 
            },
            messages :{
                post_title: {
                    required : 'Please Enter Post Title',
                    minlength: 'Your title must consist of at least 5 characters.',
                }, 
                blogcat_id: {
                    required : 'Please Select Blog Category',
                }, 
                short_descp: {
                    required : 'Please Enter Short Description',
                }, 
                post_image: {
                    required : 'Please Choose Post Image',
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
@endsection
