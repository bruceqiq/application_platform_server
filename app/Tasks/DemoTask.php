<?php
declare(strict_types=1);

namespace App\Tasks;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

/**
 * Class DemoTask
 * @Crontab(name="demo",rule="* * * * *",callback="execute")
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
        $this->logger->info(date('Y-m-d H:i:s', time()));
    }
}