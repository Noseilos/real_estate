@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Import Agent Details </h6>

                            <form id="myForm" method="POST" action="{{ route('agent.import') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Xlsx File Import </label>
                                    <input type="file" name="import_file" class="form-control">

                                </div>




                                <button type="submit" class="btn btn-inverse-warning">Upload </button>

                            </form>

                        </div>
                    </div>




                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>
@endsection
