<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserService;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    public function index()
    {
        $user = $this->userService->getById(Auth::id());
        return view('home', ['user' => $user]);
    }
}
