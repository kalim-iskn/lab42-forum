@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit profile</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
                            @csrf

                            @component('components.alerts', ["successMsg" => "You have successfully updated your password!"])
                            @endcomponent

                            <div class="row mb-3">
                                <label for="oldPassword" class="col-md-4 col-form-label text-md-end">Old Password</label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password"
                                           class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword"
                                           required>

                                    @error('oldPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-form-label text-md-end">New Password</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password"
                                           class="form-control @error('newPassword') is-invalid @enderror" name="newPassword"
                                           required>

                                    @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword_confirmation" class="col-md-4 col-form-label text-md-end">Repeat New Password</label>

                                <div class="col-md-6">
                                    <input id="newPassword_confirmation" type="password"
                                           class="form-control @error('newPassword_confirmation') is-invalid @enderror" name="newPassword_confirmation"
                                           required>

                                    @error('newPassword_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
