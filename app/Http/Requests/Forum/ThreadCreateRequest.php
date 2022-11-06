<?php

namespace App\Http\Requests\Forum;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 */
class ThreadCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
