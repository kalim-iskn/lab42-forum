@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if($user->avatar)
                        <div class="w-25">
                            <img src="{{ $user->getAvatarUrl() }}" style="max-width: 100%">
                        </div>
                    @endif

                    <ul>
                        <li>
                            Name: {{ $user->name }}
                        </li>
                        <li>
                            Email: {{ $user->email }}
                        </li>
                    </ul>

                    <p>
                        <a href="{{ route('edit-profile') }}">Edit Profile</a>
                    </p>
                    <p>
                        <a href="{{ route('edit-password') }}">Edit Password</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
