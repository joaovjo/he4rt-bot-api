<?php

declare(strict_types=1);

namespace Heart\Meeting\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class MeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'meeting_type_id' => ['required', 'integer'],
            'provider_id' => ['required'],
            'provider' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['provider' => $this->route('provider')]);
    }
}
