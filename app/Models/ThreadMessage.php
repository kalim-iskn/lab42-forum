<?php

namespace App\Models;

use App\DTO\ThreadMessageDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreadMessage extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function toDto(): ThreadMessageDTO
    {
        $dto = new ThreadMessageDTO();
        $dto->id = $this->id;
        $dto->text = $this->text;
        $dto->createdAt = $this->created_at;
        $dto->user = $this->user->toDto();
        $dto->thread = $this->thread->toDto();

        return $dto;
    }
}
