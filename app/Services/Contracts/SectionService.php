<?php

namespace App\Services\Contracts;

use App\DTO\SectionDTO;
use App\Exceptions\Forum\SectionNotFoundException;

interface SectionService
{
    /**
     * @return SectionDTO[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return SectionDTO
     * @throws SectionNotFoundException
     */
    public function find(int $id): SectionDTO;

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool;
}
