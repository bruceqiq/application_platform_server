<?php

declare(strict_types=1);

namespace App\Request\Api;

use Hyperf\Validation\Request\FormRequest;

class TokenKeyValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
<<<<<<< HEAD:app/Request/Api/TokenKeyValidate.php
            'key' => 'exists:token,key',
=======
            'key' => 'exists:app_token,key',
>>>>>>> origin/develop:app/Request/Api/KeyValidate.php
        ];
    }

    public function messages(): array
    {
        return [
            'key.exists' => 'key不存在'
        ];
    }
}
