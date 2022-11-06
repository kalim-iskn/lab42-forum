<?php

namespace App\Services\Contracts;

use App\DTO\UserDTO;
use App\Exceptions\FileNotLoadedException;
use App\Exceptions\User\OldPasswordInvalidException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditProfileRequest;

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

    /**
     * @param int $id
     * @param EditPasswordRequest $request
     * @return void
     * @throws UserNotFoundException
     * @throws OldPasswordInvalidException
     */
    public function updatePassword(int $id, EditPasswordRequest $request): void;
}
