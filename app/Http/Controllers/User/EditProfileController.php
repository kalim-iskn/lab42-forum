<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Services\Contracts\UserService;
use Auth;

class EditProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit()
    {
        $user = $this->userService->getById(Auth::id());
        return view('user.edit', ["user" => $user]);
    }

    public function update(EditProfileRequest $request)
    {
        $this->userService->update(Auth::id(), $request);
        return back()->with("status", true);
    }
}
