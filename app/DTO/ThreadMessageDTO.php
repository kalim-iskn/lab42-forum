<?php

namespace App\DTO;

use DateTime;

class ThreadMessageDTO
{
    public int $id;

    public string $text;

    public ?DateTime $createdAt;

    public UserDTO $user;

    public ThreadDTO $thread;
}
