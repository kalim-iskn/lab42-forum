<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Services\Contracts\SectionService;

class SectionController extends Controller
{
    protected SectionService $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        return view('forum.sections-list', [
            "sections" => $this->sectionService->getAll()
        ]);
    }
}
