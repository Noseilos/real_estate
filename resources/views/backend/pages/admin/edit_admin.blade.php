@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

    <div class="row profile-body">
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Add Admin</h6>
  
                                  <form id="myForm" method="POST" action="{{ route('update.admin', $user->id) }}" class="forms-sample">
                                    @csrf

                                      <div class="form-group mb-3">
                                          <label for="name" class="form-label">Admin User Name</label>
                                          <input name="username" type="text" class="form-control" value="{{ $user->username }}">
                                      </div>

                                      <div class="form-group mb-3">
                                        <label for="name" class="form-label">Admin Name</label>
                                        <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                      </div>

                                      <div class="form-group mb-3">
                                          <label for="email" class="form-label">Admin Email</label>
                                          <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                                      </div>

                                      <div class="form-group mb-3">
                                          <label for="phone" class="form-label">Admin Phone</label>
                                          <input name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                                      </div>

                                      <div class="form-group mb-3">
                                          <label for="address" class="form-label">Admin Address</label>
                                          <input name="address" type="text" class="form-control" value="{{ $user->address }}">
                                      </div>

                                      <div class="form-group mb-3">
                                        <label for="password" class="form-label">Role Name</label>
                                        <select name="roles" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Role</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                      </div>


                                      <button type="submit" class="btn btn-primary me-2">Save</button>
                                  </form>
  
                </div>
              </div>
        </div>
      </div>
    </div>

</div>

@endsection