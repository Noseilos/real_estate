@extends('agent.agent_dashboard')
@section('agent')
    @php
        $id = Auth::user()->id;
        $agentID = App\Models\User::find($id);
        $status = $agentID->status;
    @endphp

    <div class="page-content">

        @if ($status === 'active')
            <h4>Agent account is <span class="text-success">Active</span></h4>
        @else
            <h4>Agent account is <span class="text-danger">Inactive</span></h4>
            <p class="text-danger"><b>Please wait the admin will check your account for approval</b></p>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
        </div>

    </div>
@endsection
