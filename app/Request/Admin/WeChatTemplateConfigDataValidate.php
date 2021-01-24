<?php

declare(strict_types=1);

namespace App\Request\Admin;

use Hyperf\Validation\Request\FormRequest;

class WeChatTemplateConfigDataValidate extends FormRequest
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
            'wechat_template_config_id' => 'required|integer',
            'key_name'                  => 'required|max:10',
            'key_value'                 => 'sometimes|max:20',
            'key_color'                 => 'sometimes|colorHexaDecimal',

        ];
    }

    public function messages(): array
    {
        return [
            'wechat_template_config_id.required' => '发送模板不能为空',
            'wechat_template_config_id.integer'  => '发送模板类型不正确',
            'key_name.required'                  => '微信模板key不能为空',
            'key_name.max'                       => '微信模板key最大长度为10',
            'key_value.max'                      => '微信模板值最大长度为20',
            'key_color.colorHexaDecimal'         => '微信模板颜色格式不正确',
        ];
    }
}
