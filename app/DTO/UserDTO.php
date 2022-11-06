<?php

namespace App\DTO;

class UserDTO
{
    public int $id;

    public string $email;

    public string $name;

    public ?string $avatar = null;

    public function getAvatarUrl(): string
    {
        if ($this->avatar === null) {
            return "";
        }

        return asset("storage/" . $this->avatar);
    }
}
