<?php
declare(strict_types=1);

namespace App\Tasks;

use App\Services\Api\WeChatTemplate\SendService;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

/**
 * Class SendTemplateTask
 * @Crontab(name="wechat_send_template",rule="*\/10 * * * * *",callback="send",memo="微信模板消息发送")
 * @package App\Tasks
 */
class SendTemplateTask
{
    /**
     * @Inject()
     * @var SendService
     */
    protected $sendService;

    /**
     * 发送微信模板消息
     * @author kert
     */
    public function send()
    {
        // 查询当前还未发送的模板消息编号
        $items       = $this->sendService->select((array)['send_status' => 2, 'size' => 1]);
        $updateArray = [];
        foreach ($items['items'] as $value) {
            $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $value->token->token;
            // 拼接数据格式
            $sendData = [
                'touser'      => $value->touser,
                'template_id' => $value->template->template_id,
                'miniprogram' => [
                    'appid'    => $value->appid,
                    'pagepath' => $value->pageth,
                ],
                'data'        => $value->data,
                'color'       => $value->color,
            ];
            $ch       = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($sendData, 256));
            $output = curl_exec($ch);
            curl_close($ch);
            var_dump($output);
            $outputArray = json_decode($output, true);
            if (strtolower($outputArray['errmsg']) == 'ok') {
                $updateArray[] = [
                    'msgid'        => $outputArray['msgid'],
                    'id'           => $value->id,
                    'send_status'  => 2,
                    'send_message' => $outputArray['errmsg']
                ];
            } else {
                $updateArray[] = [
                    'id'           => $value->id,
                    'send_status'  => 3,
                    'send_message' => $updateArray['errmsg'],
                    'msgid'        => 0,
                ];
            }
        }
        // 更新结果
        var_dump($updateArray);
    }
}