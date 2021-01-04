<?php

declare(strict_types=1);

namespace App\Request\Api;

use Hyperf\Validation\Request\FormRequest;

class CloudKeyValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => 'exists:cloud_storage_token,key',
        ];
    }

    public function messages(): array
    {
        return [
            'key.exists' => 'key不存在'
        ];
    }
}
