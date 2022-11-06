<?php

namespace App\DTO;

use App\Services\Contracts\ThreadService;

abstract class MessagesPaginationDTO
{
    /**
     * @var ThreadMessageDTO[] $messages
     */
    public array $messages = [];

    public int $count = 0;

    public int $perPage = ThreadService::MESSAGES_PAGINATION_LIMIT;

    public int $currentPage = 1;

    public function hasPages(): bool
    {
        return $this->count > 0;
    }

    public function onFirstPage(): bool
    {
        return $this->currentPage == 1;
    }

    public function hasMorePages(): bool
    {
        $lastPage = ceil($this->count / $this->perPage);
        return $this->currentPage < $lastPage;
    }

    abstract public function previousPageUrl(): string;

    abstract public function nextPageUrl(): string;
}
