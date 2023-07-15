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
                                    @foreach ($user_message as $message)
                                        <div class="email-list-item">
                                            <a href="{{ route('agent.message.details', $message->id) }}"
                                                class="email-list-detail">
                                                <div class="content">
                                                    <span class="from">{{ $message['user']['name'] }}</span>
                                                    <p class="msg"> {{ $message->message }} </p>
                                                </div>
                                                <span class="date">
                                                    <span class="icon"><i data-feather="paperclip"></i> </span>
                                                    {{ $message->created_at->format('l M d') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
