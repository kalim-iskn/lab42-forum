<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Exceptions\User\OldPasswordInvalidException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditProfileRequest;
use App\Models\User;
use App\Services\Contracts\FileService;
use App\Services\Contracts\UserService;
use Hash;

class EloquentUserService implements UserService
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getById(int $id): UserDTO
    {
        return $this->find($id)->toDto();
    }

    public function update(int $id, EditProfileRequest $request): void
    {
        $user = $this->find($id);
        $oldAvatar = null;

        if ($request->avatar !== null) {
            $path = $this->fileService->upload($request->avatar, FileService::AVATAR_DIR);
            $oldAvatar = $user->avatar;
            $user->avatar = $path;
        }

        $user->name = $request->name;

        $user->save();

        if ($oldAvatar !== null) {
            $this->fileService->delete($oldAvatar);
        }
    }

    public function updatePassword(int $id, EditPasswordRequest $request): void
    {
        $user = $this->find($id);

        if (!Hash::check($request->oldPassword, $user->password)) {
            throw new OldPasswordInvalidException();
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();
    }

    /**
     * @throws \App\Exceptions\User\UserNotFoundException
     */
    private function find(int $id): User
    {
        $user = User::find($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
