<?php

declare(strict_types=1);

namespace App\Request\Api;

use Hyperf\Validation\Request\FormRequest;

class KeyValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => 'exists:cloud_storage,key',
        ];
    }

    public function messages(): array
    {
        return [
            'key.exists' => 'key不存在'
        ];
    }
}
