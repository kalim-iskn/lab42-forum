<?php

namespace App\Http\Controllers\User;

use App\Exceptions\FileNotLoadedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditProfileRequest;
use App\Services\Contracts\UserService;
use Auth;

class EditProfileController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit()
    {
        $user = $this->userService->getById(Auth::id());
        return view('user.edit', ["user" => $user]);
    }

    /**
     * @throws FileNotLoadedException
     */
    public function update(EditProfileRequest $request)
    {
        $this->userService->update(Auth::id(), $request);
        return back()->with("success", true);
    }
}
