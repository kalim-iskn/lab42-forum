<?php

namespace App\Http\Requests\Forum;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $text
 * @property int $threadId
 */
class ThreadMessageCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "text" => "required|string|max:5000",
            "threadId" => "required|int|exists:threads,id"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
