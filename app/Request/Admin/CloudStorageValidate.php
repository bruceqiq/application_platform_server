<?php

declare(strict_types=1);

namespace App\Request\Admin;

use Hyperf\Validation\Request\FormRequest;

class CloudStorageValidate extends FormRequest
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
            'cloud_platform_id' => 'required|integer',
            'app_id'            => 'required',
            'app_secret'        => 'required',
            'name'              => 'required',
            'region'            => 'required',
            'bucket'            => 'required',
            'domain'            => 'required',
            'remark'            => 'sometimes',
        ];
    }

    public function messages(): array
    {
        return [
            'cloud_platform_id.required' => '平台不能为空',
            'cloud_platform_id.integer'  => '平台类型不正确',
            'app_id.required'            => 'appId不能为空',
            'app_secret.required'        => 'appSecret不能为空',
            'name.required'              => '应用名称不能为空',
            'region.required'            => '应用地区不能为空',
            'bucket.required'            => '应用bucket不能为空',
            'domain.required'            => '应用域名不能为空',
        ];
    }
}
