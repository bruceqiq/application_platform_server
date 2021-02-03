<?php
declare(strict_types=1);

namespace App\Tasks;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

/**
 * Class DemoTask
 * @Crontab(name="demo",rule="*\/10 * * * * *",callback="execute")
 * @package App\Tasks
 */
class DemoTask
{
    /**
     * @Inject()
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function execute()
    {
        var_dump(date('Y-m-d H:i:s', time()));
        $accessToken = '41_gYc4PpYSjrrUV3Ji6NGGpOr2Emu0Y9Bc_Tti9h3mG-8zDGyxpcyxkxqos4fhjqv5bCk-SSfw7TKRLuzWA1dnOAF2LwYGaiVLNbdJYA5MdiZWioVpVItvMxBNIHtEKtCrqIhpG0wDi3xHCk5gPJAcABAYSJ';
        $url         = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $accessToken;
        $data        = [
            "touser"      => "o28QAvyW73VDRaEQSNANozIJWXlM",
            "template_id" => "bszOTD4My8favnH7HuSeS2EYVRc0aDSg6POh3-A_ux4",
            "data"        => [
                "first"    => ["value" => '测试'],
                "keyword1" => ["value" => 'keywor1'],
                "keyword2" => ["value" => 'keywor2'],
                "keyword3" => ["value" => 'keywor3'],
                "remark"   => ["value" => "备注信息"],
            ]
        ];
        $data        = json_encode($data, 256);
        $ch          = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        var_dump($output);
        $this->logger->info(date('Y-m-d H:i:s', time()));
    }
}
