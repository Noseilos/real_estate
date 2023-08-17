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

                            <h6 class="card-title">Edit Testimonial </h6>

                            <form method="POST" action="{{ route('update.testimonials') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $testimonial->id }}">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> Name </label>
                                    <input type="text" name="name" class="form-control "
                                        value="{{ $testimonial->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> Position </label>
                                    <input type="text" name="position" class="form-control "
                                        value="{{ $testimonial->position }}">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> Message </label>
                                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3">
         {{ $testimonial->message }} 

             </textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Testimonial Photo </label>
                                    <input class="form-control" name="image" type="file" id="image">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> </label>
                                    <img id="showImage" class="wd-80 rounded-circle" src="{{ asset($testimonial->image) }}"
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

    <!--  /// Multi Image Update //// -->

    <div class="page-content" style="margin-top: -35px;">

      <div class="row profile-body">
          <div class="col-md-12 col-xl-12 middle-wrapper">
              <div class="row">

                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title"> Edit Multiple Images</h6>

                          <form method="post" action="{{ route('update.testimonial.multiImage') }}" id="myForm"
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
                                                      <a href="{{ route('delete.testimonial.multiImage', $img->id) }}"
                                                          class="btn btn-danger" id="delete">Delete</a>
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </form>




                          <form method="POST" action="{{ route('store.new.multiImage.testimonial') }}" id="myForm"
                              enctype="multipart/form-data">
                              @csrf

                              <input type="hidden" name="imageId" value="{{ $testimonial->id }}">

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
