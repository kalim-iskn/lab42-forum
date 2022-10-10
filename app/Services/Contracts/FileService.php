<?php

namespace App\Services\Contracts;

use App\Exceptions\FileNotLoadedException;
use Illuminate\Http\UploadedFile;

interface FileService
{
    final public const AVATAR_DIR = "avatars";

    /**
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string
     * @throws FileNotLoadedException
     */
    public function upload(UploadedFile $file, string $directory, string $disk = "public"): string;

    /**
     * @param string $path
     * @param string $disk
     * @return void
     */
    public function delete(string $path, string $disk = "public"): void;
}
