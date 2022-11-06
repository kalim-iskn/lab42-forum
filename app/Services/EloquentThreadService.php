<?php

namespace App\Services;

use App\DTO\MessagesPaginationDTO;
use App\DTO\ThreadDTO;
use App\DTO\ThreadMessagesPaginationDTO;
use App\DTO\UserMessagesPaginationDTO;
use App\Exceptions\Forum\SectionNotFoundException;
use App\Exceptions\Forum\ThreadNotFoundException;
use App\Http\Requests\Forum\ThreadCreateRequest;
use App\Http\Requests\Forum\ThreadMessageCreateRequest;
use App\Models\Thread;
use App\Models\ThreadMessage;
use App\Services\Contracts\SectionService;
use App\Services\Contracts\ThreadService;
use Auth;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;

class EloquentThreadService implements ThreadService
{
    protected SectionService $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function getBySectionId(int $sectionId): array
    {
        $threads = Thread::whereSectionId($sectionId)->get();
        $threadsDto = [];

        foreach ($threads as $thread) {
            $threadsDto[] = $thread->toDto();
        }

        return $threadsDto;
    }

    public function store(int $sectionId, ThreadCreateRequest $request): ThreadDTO
    {
        if (!$this->sectionService->exists($sectionId)) {
            throw new SectionNotFoundException();
        }

        $thread = new Thread();
        $thread->name = $request->name;
        $thread->section_id = $sectionId;

        $thread->save();

        return $thread->toDto();
    }

    public function find(int $id): ThreadDTO
    {
        $thread = Thread::find($id);

        if (!$thread) {
            throw new ThreadNotFoundException();
        }

        return $thread->toDto(true);
    }

    public function getMessages(int $threadId, int $page): ThreadMessagesPaginationDTO
    {
        if ($page < 1) {
            throw new Exception("invalid page number");
        }

        $dto = new ThreadMessagesPaginationDTO();

        $pagination = ThreadMessage::whereThreadId($threadId)
            ->select("*")
            ->with("user")
            ->with("thread")
            ->paginate(self::MESSAGES_PAGINATION_LIMIT, [], "page", $page);

        $this->initPagination($dto, $pagination, $page);

        $dto->threadId = $threadId;

        return $dto;
    }

    public function getMessagesByUserId(int $userId, int $page): UserMessagesPaginationDTO
    {
        if ($page < 1) {
            throw new Exception("invalid page number");
        }

        $dto = new UserMessagesPaginationDTO();

        $pagination = ThreadMessage::whereUserId($userId)
            ->select("*")
            ->with("user")
            ->with("thread")
            ->paginate(self::MESSAGES_PAGINATION_LIMIT, [], "page", $page);

        $this->initPagination($dto, $pagination, $page);

        return $dto;
    }

    public function storeMessage(ThreadMessageCreateRequest $request): void
    {
        $msg = new ThreadMessage();
        $msg->text = $request->text;
        $msg->thread_id = $request->threadId;
        $msg->user_id = Auth::id();

        $msg->save();
    }

    protected function initPagination(MessagesPaginationDTO $dto, Paginator $pagination, int $page): void
    {
        foreach ($pagination->items() as $msg) {
            $dto->messages[] = $msg->toDto();
        }

        $dto->count = $pagination->total();
        $dto->currentPage = $page;
    }
}
