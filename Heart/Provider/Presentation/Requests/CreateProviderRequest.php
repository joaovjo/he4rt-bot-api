<?php

declare(strict_types=1);

namespace Heart\Provider\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider' => ['required', 'in:discord,twitch'],
            'provider_id' => ['required'],
            'username' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['provider' => $this->route('provider')]);
    }
}
