<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use App\Services\Contracts\FileService;
use App\Services\Contracts\UserService;

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

    /**
     * @throws UserNotFoundException
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
