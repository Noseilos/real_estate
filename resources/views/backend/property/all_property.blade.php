@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.property')}}" class="btn btn-inverse-info">Add Property</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Properties</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Serial#</th>
            <th>Image</th>
            <th>Property Name</th>
            <th>Property Type</th>
            <th>Status Type</th>
            <th>City</th>
            <th>Code</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
            @foreach ($property as $key => $item)
                
            <tr>
                <td>{{ $key+1 }}</td>
                <td><img src="{{ asset($item->property_thumbnail) }}" alt="property thumbnail" style="width:70px; height:40px;"></td>
                <td>{{ $item->property_name }}</td>
                <td>{{ $item['type']['type_name'] }}</td>
                <td>{{ $item->property_status }}</td>
                <td>{{ $item->city }}</td>
                <td>{{ $item->property_code }}</td>
                <td>
                    @if ($item->status == 1)
                        <span class="badge rounded-pill bg-success">Active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('edit.property', $item->id)}}" class="btn btn-outline-warning">Edit</a>
                    <a href="{{ route('delete.amenities', $item->id)}}" id="delete" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>

            @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
</div>
        </div>
    </div>

</div>

@endsection