<?php

namespace App\DTO;

class UserMessagesPaginationDTO extends MessagesPaginationDTO
{
    public function previousPageUrl(): string
    {
        return route("user-messages-list", ["page" => $this->currentPage - 1]);
    }

    public function nextPageUrl(): string
    {
        return route("user-messages-list", ["page" => $this->currentPage + 1]);
    }
}
