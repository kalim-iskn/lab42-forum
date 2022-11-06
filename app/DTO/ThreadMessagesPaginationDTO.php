<?php

namespace App\DTO;

class ThreadMessagesPaginationDTO extends MessagesPaginationDTO
{
    public int $threadId;

    public function nextPageUrl(): string
    {
        return route("show-thread", ["id" => $this->threadId, "page" => $this->currentPage + 1]);
    }

    public function previousPageUrl(): string
    {
        return route("show-thread", ["id" => $this->threadId, "page" => $this->currentPage - 1]);
    }
}
