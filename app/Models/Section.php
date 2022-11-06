<?php

namespace App\Models;

use App\DTO\SectionDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function toDto(): SectionDTO
    {
        $dto = new SectionDTO();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->createdAt = $this->created_at;

        return $dto;
    }
}
