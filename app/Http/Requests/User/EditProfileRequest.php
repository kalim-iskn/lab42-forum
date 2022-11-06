<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $name
 * @property UploadedFile $avatar
 */
class EditProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "avatar" => "nullable|image|max:3072"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
