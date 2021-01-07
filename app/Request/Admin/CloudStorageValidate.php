<?php

declare(strict_types=1);

namespace App\Request\Admin;

use Hyperf\Validation\Request\FormRequest;

class CloudStorageValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cloud_platform_id' => 'required|integer|exists:cloud_platform,id',
            'app_id'            => 'required',
            'app_secret'        => 'required',
            'name'              => 'required',
            'region'            => 'required',
            'bucket'            => 'required',
            'domain'            => 'required',
            'remark'            => 'sometimes',
            'cache_time'        => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'cloud_platform_id.required' => '平台不能为空',
            'cloud_platform_id.integer'  => '平台类型不正确',
            'cloud_platform_id.exists'   => '平台不存在',
            'app_id.required'            => 'appId不能为空',
            'app_secret.required'        => 'appSecret不能为空',
            'name.required'              => '应用名称不能为空',
            'region.required'            => '应用地区不能为空',
            'bucket.required'            => '应用bucket不能为空',
            'domain.required'            => '应用域名不能为空',
            'cache_time.required'        => '缓存有效期不能为空',
            'cache_time.integer'         => '缓存有效期格式不正确',
        ];
    }
}
