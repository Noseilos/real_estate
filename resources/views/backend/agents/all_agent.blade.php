@extends('admin.admin_dashboard')
@section('admin')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
  
  @if (Auth::user()->can('agent.add'))
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.agent')}}" class="btn btn-inverse-info">Add Agent</a>
            &nbsp; &nbsp; &nbsp;
            <a href="{{ route('import.agent') }}" class="btn btn-inverse-warning"> Import</a>
        </ol>
    </nav>
  @endif

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
                <td><img src="{{ (!empty($item->photo)) ? url('upload/agent_images/'.$item->photo) : url('upload/no_image.jpg') }}" alt="Agent Picture" style="width:60px; height:60px;"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    @if ($item->status == 'active')
                        <span class="badge rounded-pill bg-success">Active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                  <input data-id="{{ $item->id }}" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" type="checkbox" {{ $item->status ? 'checked' : '' }}>
                </td>
                <td>
                    <a href="{{ route('edit.agent', $item->id)}}" class="btn btn-outline-warning" title="Edit"><i data-feather="edit"></i></a>
                    <a href="{{ route('delete.agent', $item->id)}}" id="delete" class="btn btn-outline-danger" title="Delete"><i data-feather="trash"></i></a>
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


<script type="text/javascript">
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              // console.log(data.success)

                // Start Message 

            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })

            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }

              // End Message   


            }
        });
    })
  })
</script>

@endsection