@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route("sections-list") }}">Sections</a>
                        /
                        {{ $section->name }}
                    </div>
                    <div class="card-body">
                        <a href="{{ route("create-thread", ["sectionId" => $section->id]) }}" class="btn btn-primary">Add new thread</a>
                        <ul class="mt-3">
                            @foreach($threads as $thread)
                                <li>
                                    <a href="{{ route("show-thread", ["id" => $thread->id]) }}">{{ $thread->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
