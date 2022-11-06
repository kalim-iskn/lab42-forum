<?php

namespace App\DTO;

use DateTime;

class ThreadDTO
{
    public int $id;

    public string $name;

    public ?DateTime $createdAt;

    public ?SectionDTO $section = null;
}
