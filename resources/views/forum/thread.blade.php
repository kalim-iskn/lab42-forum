@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route("sections-list") }}">Sections</a>
                        /
                        <a href="{{ route("threads-list", ["sectionId" => $thread->section->id]) }}">{{ $thread->section->name }}</a>
                        /
                        {{ $thread->name }}
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

                        @auth
                            <div class="card mt-2">
                                <div class="card-body">
                                    <form method="POST" action="{{ route("store-message") }}">
                                        @csrf
                                        <input type="hidden" name="threadId" value="{{ $thread->id }}">
                                        <div class="row mb-3">
                                            <label for="text" class="col-md-4 col-form-label text-md-end">Text</label>

                                            <div class="col-md-6">
                                            <textarea id="text"
                                                      class="form-control @error('text') is-invalid @enderror"
                                                      name="text"
                                                      required rows="6">{{ old('text') }}</textarea>

                                                @error('text')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Send
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
