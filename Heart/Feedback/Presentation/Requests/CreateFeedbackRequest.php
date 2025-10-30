<?php

declare(strict_types=1);

namespace Heart\Feedback\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sender_id' => [
                'required',
                'different:target_id',
            ],
            'target_id' => [
                'required',
                'different:sender_id',
            ],
            'message' => [
                'required',
                'string',
                'max:4000',
            ],
            'type' => [
                'required',
                'string',
            ],
        ];
    }
}
