<?php

namespace App\Models;

use App\DTO\ThreadDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function toDto(bool $withSection = false): ThreadDTO
    {
        $dto = new ThreadDTO();
        $dto->id = $this->id;
        $dto->name = $this->name;

        if ($withSection) {
            $dto->section = $this->section->toDto();
        }

        $dto->createdAt = $this->created_at;

        return $dto;
    }
}
