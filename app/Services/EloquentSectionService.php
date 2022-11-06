<?php

namespace App\Services;

use App\DTO\SectionDTO;
use App\Exceptions\Forum\SectionNotFoundException;
use App\Models\Section;
use App\Services\Contracts\SectionService;

class EloquentSectionService implements SectionService
{
    public function getAll(): array
    {
        $all = Section::all();

        $sectionsDto = [];

        foreach ($all as $section) {
            $sectionsDto[] = $section->toDto();
        }

        return $sectionsDto;
    }

    public function find(int $id): SectionDTO
    {
        $section = Section::find($id);

        if (!$section) {
            throw new SectionNotFoundException();
        }

        return $section->toDto();
    }

    public function exists(int $id): bool
    {
        return Section::whereId($id)->exists();
    }
}
