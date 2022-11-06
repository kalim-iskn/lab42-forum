<?php

namespace App\Services\Contracts;

use App\DTO\ThreadDTO;
use App\DTO\ThreadMessagesPaginationDTO;
use App\DTO\UserMessagesPaginationDTO;
use App\Exceptions\Forum\ThreadNotFoundException;
use App\Http\Requests\Forum\ThreadCreateRequest;
use App\Http\Requests\Forum\ThreadMessageCreateRequest;
use Exception;

interface ThreadService
{
    const MESSAGES_PAGINATION_LIMIT = 10;

    /**
     * @return ThreadDTO[]
     */
    public function getBySectionId(int $sectionId): array;

    /**
     * @param int $sectionId
     * @param ThreadCreateRequest $request
     * @return void
     */
    public function store(int $sectionId, ThreadCreateRequest $request): ThreadDTO;

    /**
     * @param int $id
     * @return ThreadDTO
     * @throws ThreadNotFoundException
     */
    public function find(int $id): ThreadDTO;

    /**
     * @param int $threadId
     * @param int $page
     * @return ThreadMessagesPaginationDTO
     * @throws Exception
     */
    public function getMessages(int $threadId, int $page): ThreadMessagesPaginationDTO;

    public function getMessagesByUserId(int $userId, int $page): UserMessagesPaginationDTO;

    /**
     * @param ThreadMessageCreateRequest $request
     * @return void
     */
    public function storeMessage(ThreadMessageCreateRequest $request): void;
}
