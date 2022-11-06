<?php

namespace App\DTO;

use DateTime;

class SectionDTO
{
    public int $id;

    public string $name;

    public ?DateTime $createdAt;
}
