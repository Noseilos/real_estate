@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Property Statuses</h6>
                        </div>
                        <p class="text-muted">A doughnut chart that displays the number of properties per property type. The pie chart will display the number of schedule requests on a property</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="myDoughnutChart" width="400" height="400"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="myPieChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Property Wishes</h6>
                        </div>
                        <p class="text-muted">This bar chart displays the number of wishes a specific user has</p>
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="myBarChart" width="500" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="{{ asset('backend/assets/js/custom/chart.js') }}"></script>
        <script> 
            var ptypeData = @json($propertyTypeData);
            var pschedData = @json($propertySchedData);
            var pWishData = @json($propertyWishData);
        </script>

    </div>
@endsection
