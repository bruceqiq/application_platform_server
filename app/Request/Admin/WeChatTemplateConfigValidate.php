<?php

declare(strict_types=1);

namespace App\Request\Admin;

use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

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
            'send_style'  => ['required', Rule::in([1, 2])],
            'send_time'   => 'required|timeDate',
            'color'       => 'sometimes|colorHexaDecimal',
        ];
    }

    public function messages(): array
    {
        return [
            'token_id.required'      => '微信Token配置不能为空',
            'token_id.integer'       => '微信Token配置格式不正确',
            'name.required'          => '模板名称不能为空',
            'name.max'               => '模板配置最大长度为32',
            'template_id.required'   => '微信模板不能为空',
            'template_id.max'        => '微信模板配置最大长度为32',
            'send_style.required'    => '发送方式不能为空',
            'send_time.required'     => '发送频率不能为空',
            'send_time.timeDate'     => '发送频率格式不正确',
            'color.colorHexaDecimal' => '模板文字格式不正确',
        ];
    }
}
