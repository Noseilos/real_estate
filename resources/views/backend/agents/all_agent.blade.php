@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.property')}}" class="btn btn-inverse-info">Add Agent</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Agent</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Serial#</th>
            <th>Image</th>
            <th>Agent Name</th>
            <th>Role</th>
            <th>Status</th>
            <th>Change</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
            @foreach ($allAgent as $key => $item)
                
            <tr>
                <td>{{ $key+1 }}</td>
                <td><img src="{{ (!empty($item->photo)) ? url('upload/agent_images/'.$item->photo) : url('upload/no_image.jpg') }}" alt="Agent Picture" style="width:70px; height:40px;"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    @if ($item->status == 'active')
                        <span class="badge rounded-pill bg-success">Active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>Change</td>
                <td>
                    <a href="{{ route('edit.property', $item->id)}}" class="btn btn-outline-warning" title="Edit"><i data-feather="edit"></i></a>
                    <a href="{{ route('delete.property', $item->id)}}" id="delete" class="btn btn-outline-danger" title="Delete"><i data-feather="trash"></i></a>
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