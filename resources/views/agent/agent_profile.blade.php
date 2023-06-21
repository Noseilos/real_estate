@extends('agent.agent_dashboard')
@section('agent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">

              <div>
                <img class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                <span class="h4 ms-3">{{ $profileData->username }}</span>
              </div>

              
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
              <p class="text-muted">{{ $profileData->username }}</p>
            </div>

            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
              <p class="text-muted">{{ $profileData->name }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{ $profileData->email }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
              <p class="text-muted">{{ $profileData->phone }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
              <p class="text-muted">{{ $profileData->address }}</p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Profile Update</h6>
  
                                  <form method="POST" action="{{ route('agent.profile.store') }}" enctype="multipart/form-data" class="forms-sample">
                                    @csrf

                                      <div class="mb-3">
                                          <label for="username" class="form-label">Username</label>
                                          <input name="username" type="text" class="form-control" id="username" autocomplete="off" value="{{ $profileData->username }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="name" class="form-label">Name</label>
                                          <input name="name" type="text" class="form-control" id="name" autocomplete="off" value="{{ $profileData->name }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="email" class="form-label">Email</label>
                                          <input name="email" type="text" class="form-control" id="email" autocomplete="off" value="{{ $profileData->email }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="phone" class="form-label">Phone</label>
                                          <input name="phone" type="text" class="form-control" id="phone" autocomplete="off" value="{{ $profileData->phone }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="address" class="form-label">Address</label>
                                          <input name="address" type="text" class="form-control" id="address" autocomplete="off" value="{{ $profileData->address }}">
                                      </div>

                                      
                                      <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input name="photo" class="form-control" type="file" id="image">
                                      </div>

                                      <div class="mb-3">
                                        <img id="showImage" class="wd-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                                      </div>

                                      <button type="submit" class="btn btn-primary me-2">Save</button>
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

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);


            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection