@extends('agent.agent_dashboard')
@section('agent')

    <div class="page-content">
        <div class="row inbox-wrapper">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-3 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-end mb-2 mb-md-0">
                                                <i data-feather="inbox" class="text-muted me-2"></i>
                                                <h4 class="me-1">Inbox</h4>
                                                <span class="text-muted">({{ count($user_message) }} new messages)</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Search mail...">
                                                <button class="btn btn-light btn-icon" type="button"
                                                    id="button-search-addon"><i data-feather="search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="email-list">
                                    <!-- email list item -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Customer Name : </th>
                                                    <td>{{ $message_details['user']['name'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Customer Email : </th>
                                                    <td>{{ $message_details['user']['email'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Customer Phone : </th>
                                                    <td>{{ $message_details['user']['phone'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Property Name : </th>
                                                    <td>{{ $message_details['property']['property_name'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Property Code : </th>
                                                    <td>{{ $message_details['property']['property_code'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Property Status : </th>
                                                    <td>{{ $message_details['property']['property_status'] }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Message : </th>
                                                    <td>{{ $message_details->message }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Sending Time : </th>
                                                    <td>{{ $message_details->created_at->format('l M d') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
