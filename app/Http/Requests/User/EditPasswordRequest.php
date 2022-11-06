<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $oldPassword
 * @property string $newPassword
 */
class EditPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "oldPassword" => ['required', 'string'],
            "newPassword" => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
