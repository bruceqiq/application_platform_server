<?php

declare(strict_types=1);

namespace App\Request\Admin;

use Hyperf\Validation\Request\FormRequest;

class WeChatTemplateConfigValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'token_id'    => 'required|integer',
            'name'        => 'required|max:32',
            'template_id' => 'required|max:32',
            'send_style'  => 'required|in:1,2',
            'send_time'   => 'required|time_date',
            'color'       => 'sometimes|hex_decimal',
            'status'      => 'required|in:1,2'
        ];
    }

    public function messages(): array
    {
        return [
            'token_id.required'    => '微信Token配置不能为空',
            'token_id.integer'     => '微信Token配置格式不正确',
            'name.required'        => '模板名称不能为空',
            'name.max'             => '模板配置最大长度为32',
            'template_id.required' => '微信模板不能为空',
            'template_id.max'      => '微信模板配置最大长度为32',
            'send_style.required'  => '发送方式不能为空',
            'send_style.in'        => '发送方式只能是1或者2',
            'status.in'            => '发送方式只能是1或者2',
            'send_time.required'   => '发送频率不能为空',
            'send_time.time_date'  => '发送频率格式不正确',
            'color.hex_decimal'    => '模板文字颜色格式不正确',
        ];
    }
}
