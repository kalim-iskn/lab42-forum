<?php

namespace App\Services\Contracts;

use App\DTO\UserDTO;
use App\Exceptions\FileNotLoadedException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\EditProfileRequest;

interface UserService
{
    /**
     * @param int $id
     * @return UserDTO
     * @throws UserNotFoundException
     */
    public function getById(int $id): UserDTO;

    /**
     * @param int $id
     * @param EditProfileRequest $request
     * @return void
     * @throws FileNotLoadedException
     * @throws UserNotFoundException
     */
    public function update(int $id, EditProfileRequest $request): void;
}
