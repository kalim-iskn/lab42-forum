@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sections</div>

                    <div class="card-body">
                        <ul>
                            @foreach($sections as $section)
                                <li>
                                    <a href="{{ route("threads-list", ['sectionId' => $section->id]) }}">{{ $section->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
