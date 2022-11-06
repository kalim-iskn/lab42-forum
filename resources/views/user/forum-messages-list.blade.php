@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        My messages
                    </div>

                    <div class="card-body">
                        @foreach($messagesPagination->messages as $msg)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ $msg->user->getAvatarUrl() }}" style="max-width: 100%; max-height: 200px">
                                            <div class="mt-2 fw-bold">
                                                {{ $msg->user->name }}
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div>
                                                <a href="{{ route("show-thread", ["id" => $msg->thread->id]) }}">{{ $msg->thread->name }}</a>
                                            </div>
                                            {!! nl2br(e($msg->text)) !!}
                                            <div class="mt-3" style="color: gray">{{ $msg->createdAt }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            @component("pagination::simple-bootstrap-5", ["paginator" => $messagesPagination])@endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
