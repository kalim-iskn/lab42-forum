<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get("", [\App\Http\Controllers\Forum\SectionController::class, 'index'])
    ->name("sections-list");

Route::controller(\App\Http\Controllers\Forum\ThreadController::class)
    ->group(function () {

        Route::prefix("section/{sectionId}/")
            ->where(['sectionId' => '[0-9]+'])
            ->group(function () {

                Route::get("threads", "index")
                    ->name("threads-list");

                Route::middleware('auth')
                    ->group(function () {
                        Route::get("create", "create")
                            ->name("create-thread");

                        Route::post("store", "store")
                            ->name("store-thread");
                    });

            });

        Route::get("thread/{id}", 'show')
            ->where(['id' => '[0-9]+'])
            ->name("show-thread");

        Route::post("thread/messages/store", 'storeMessage')
            ->middleware("auth")
            ->name("store-message");

        Route::get("threads/messages/my", 'userMessages')
            ->middleware("auth")
            ->name("user-messages-list");
    });

Route::middleware('auth')
    ->group(function () {
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])
            ->name('home');

        Route::controller(\App\Http\Controllers\User\EditProfileController::class)
            ->prefix('/edit')
            ->group(function () {
                Route::get('', 'edit')
                    ->name('edit-profile');

                Route::post('', 'update')
                    ->name('update-profile');
            });

        Route::controller(\App\Http\Controllers\User\EditPasswordController::class)
            ->prefix('password/edit')
            ->group(function () {
                Route::get('', 'edit')
                    ->name('edit-password');

                Route::post('', 'update')
                    ->name('update-password');
            });
    });
