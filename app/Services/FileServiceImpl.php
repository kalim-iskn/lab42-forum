<?php

namespace App\Services;

use App\Exceptions\FileNotLoadedException;
use App\Services\Contracts\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileServiceImpl implements FileService
{
    public function upload(UploadedFile $file, string $directory, string $disk = "public"): string
    {
        $fileName = $this->getHashName($file);
        $uploadFilePath = $disk . DIRECTORY_SEPARATOR . $directory;

        $isUploaded = Storage::putFileAs($uploadFilePath, $file, $fileName, $disk) !== false;

        if ($isUploaded !== false) {
            return $directory . DIRECTORY_SEPARATOR . $fileName;
        } else {
            throw new FileNotLoadedException();
        }
    }

    public function delete(string $path, string $disk = "public"): void
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    private function getHashName(UploadedFile $file): string
    {
        $filename = md5($file->getClientOriginalName() . $file->hashName() . microtime());
        return $filename . "." . $file->extension();
    }
}
