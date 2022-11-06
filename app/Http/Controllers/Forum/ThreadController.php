<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\ThreadCreateRequest;
use App\Http\Requests\Forum\ThreadMessageCreateRequest;
use App\Services\Contracts\SectionService;
use App\Services\Contracts\ThreadService;
use Auth;
use Exception;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    protected SectionService $sectionService;
    protected ThreadService $threadService;

    public function __construct(SectionService $sectionService, ThreadService $threadService)
    {
        $this->sectionService = $sectionService;
        $this->threadService = $threadService;
    }

    public function index(int $sectionId)
    {
        $section = $this->sectionService->find($sectionId);
        $threads = $this->threadService->getBySectionId($sectionId);
        return view("forum.threads-list", [
            "section" => $section,
            "threads" => $threads
        ]);
    }

    /**
     * @throws Exception
     */
    public function show(int $id, Request $request)
    {
        $this->validatePage($request);

        $page = $request->get("page", 1);
        $thread = $this->threadService->find($id);
        $messagesPagination = $this->threadService->getMessages($id, $page);

        return view("forum.thread", [
            "thread" => $thread,
            "messagesPagination" => $messagesPagination
        ]);
    }

    public function create(int $sectionId)
    {
        $section = $this->sectionService->find($sectionId);

        return view("forum.create-thread", [
            "section" => $section
        ]);
    }

    public function store(int $sectionId, ThreadCreateRequest $request)
    {
        $thread = $this->threadService->store($sectionId, $request);
        return redirect(route("show-thread", ["id" => $thread->id]));
    }

    public function storeMessage(ThreadMessageCreateRequest $request)
    {
        $this->threadService->storeMessage($request);
        return redirect(route("show-thread", ["id" => $request->threadId]));
    }

    public function userMessages(Request $request)
    {
        $this->validatePage($request);

        $page = $request->get("page", 1);
        $messagesPagination = $this->threadService->getMessagesByUserId(Auth::id(), $page);

        return view("user.forum-messages-list", [
            "messagesPagination" => $messagesPagination
        ]);
    }

    protected function validatePage(Request $request): void
    {
        $request->validate([
            "page" => "nullable|int|min:1"
        ]);
    }
}
