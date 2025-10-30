<?php

declare(strict_types=1);

namespace Heart\Character\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ClaimBadgeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'redeem_code' => ['required', 'string'],
        ];
    }
}
