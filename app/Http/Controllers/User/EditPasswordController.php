<?php

namespace App\Http\Controllers\User;

use App\Exceptions\User\OldPasswordInvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditPasswordRequest;
use App\Services\Contracts\UserService;
use Auth;

class EditPasswordController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit()
    {
        $user = $this->userService->getById(Auth::id());
        return view('user.edit-password', ["user" => $user]);
    }

    /**
     * @throws OldPasswordInvalidException
     */
    public function update(EditPasswordRequest $request)
    {
        $this->userService->updatePassword(Auth::id(), $request);
        return back()->with("success", true);
    }
}
