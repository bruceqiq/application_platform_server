<?php
declare(strict_types=1);

namespace App\Listener;


use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\Event\ValidatorFactoryResolved;

/**
 * 自定义验证异常
 * Class ValidatorFactoryResolvedListener
 * @package App\Listener
 */
class ValidatorFactoryResolvedListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
            ValidatorFactoryResolved::class,
        ];
    }

    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     * @param object $event
     */
    public function process(object $event)
    {
        /**  @var ValidatorFactoryInterface $validatorFactory */
        $validatorFactory = $event->validatorFactory;
        // 注册了时间或者日期验证器(允许被验证的的属性对应的值，可以是秒数或者日期格式)
        $validatorFactory->extend('time_date', function ($attribute, $value, $parameters, $validator) {
            if (is_numeric($value)) {
                return true;
            }
            return false;
        });
        // 验证是否是十六进制的颜色格式
        $validatorFactory->extend('hex_decimal', function ($attribute, $value, $parameters, $validator) {
            $result = preg_match('/^#[A-Z|a-z|0-9]{3,6}$/', $value);
            if (!empty($result)) {
                return true;
            }
            return false;
        });
    }
}